<?php

namespace App\Http\Controllers;

use Jobseeker\App\Models\User;
use Jobseeker\App\Models\Job;
use Jobseeker\App\Models\Application;

use Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;


class JobController
{
    protected $view;
    protected $db;
    protected $validator;
    protected $session;
    protected $flash;
    protected $router;

    public function __construct(ContainerInterface $container) {
        $this->view = $container->get('view');
        $this->db = $container->get('db');
        $this->validator = $container->get('validator');
        $this->flash = $container->get('flash');
        $this->session = $container->get('session');
        $this->router = $container->get('router');
    }

    public function offers($request, $response, $args)
    {
        $user = $this->session->user;

        $user = User::find($user->id);

        $offers = User::find($user->id)->jobs()->wherePivot('status', 'approved')->get();
        
        return $this->view->render($response, 'frontend/job/offers.html', [
            'user' => $user,
            'offers' => $offers
        ]);
    }

    public function create($request, $response, $args)
    {
        $user = $this->session->user;

        $user = User::find($user->id);

        if($request->isPost()) {
            $payload = $request->getParsedBody();

            $this->validator->validate($request, [
                'company' => V::notBlank(),
                'title' => V::notBlank(),
                'position' => V::notBlank(),
                'description' => V::notBlank(),
                'salary_range' => V::numeric()->notBlank(),
                'total_candidate_needed' => V::numeric()->notBlank(),
                'closing_date' => V::notBlank(),
            ]);
            
            $createdByUserId = ['created_by_user_id' => $user->id];

            if(!$this->validator->isValid()) {
                return $this->view->render($response, 'frontend/job/create.html', [
                    'user' => $user
                ]);
            }

            $this->db->table('jobs')->insert(array_merge($payload, $createdByUserId));

            $this->flash->addMessage('success', 'Job has been publish successfully');

            return $response->withRedirect($this->router->pathFor('job:create'));
        }

        return $this->view->render($response, 'frontend/job/create.html', [
            'user' => $user
        ]);
    }

    public function search($request, $response, $args)
    {
        $user = $this->session->user;

        $user = User::find($user->id);
        
        // $degrees = [
        //     'ond' => 1,
        //     'hnd' => 2,
        //     'bsc' => 3,
        //     'btech' => 4,
        //     'masters' => 5,
        //     'phd' => 6,
        // ];

        $jobs = Job::where('rate', '<', $user->survey_total)->get();

        if($user->step_completed == 1) {
            $this->flash->addMessage('error', 'Please, take the survey before you can access dashboard');

            return $response->withRedirect($this->router->pathFor('user:survey'));
        }

        return $this->view->render($response, 'frontend/job/search.html', [
            'user' => $user,
            'jobs' => $jobs,
        ]);
    }

    public function browse($request, $response, $args)
    {
        $user = $this->session->user;

        $user = User::find($user->id);

        $jobs = Job::get();

        return $this->view->render($response, 'frontend/job/browse.html', [
            'user' => $user,
            'jobs' => $jobs,
        ]);
    }

    public function apply($request, $response, $args)
    {
        $user = $this->session->user;

        $user = User::find($user->id);

        $job = Job::find($args['id']);

        if (!$job) {
            $this->flash->addMessage('error', 'Job is no longer valid');

            return $response->withRedirect($this->router->pathFor('job:search'));
        }

        $application = $this->db->table('applications')->where('job_id', $job->id)->where('applicant_id', $user->id)->first();

        if($application) {
            $this->flash->addMessage('success', 'You have already applied for this job before');

            return $response->withRedirect($this->router->pathFor('user:applications'));
        }

        $data = [
            'applicant_id' => $user->id,
            'job_id' => $job->id,
            'status' => 'applied',
        ];

        $this->db->table('applications')->insert($data);
        
        $this->flash->addMessage('success', 'Application is successful');

        return $response->withRedirect($this->router->pathFor('user:applications'));

        // return $this->view->render($response, 'frontend/job/search.html', [
        //     'user' => $user,
        //     'jobs' => $jobs,
        // ]);
    }

    public function applications($request, $response, $args)
    {
        $user = $this->session->user;

        $user = User::find($user->id);
        
        $job = Job::with('users')->find($args['job_id']);
        
        return $this->view->render($response, 'frontend/job/applications.html', [
            'user' => $user,
            'job' => $job,
        ]);
    }

    public function application_update($request, $response, $args)
    {
        $application = Application::find($args['application_id']);

        if(!$application) {
            $this->flash->addMessage('error', 'Invalid Application Id');

            return $response->withRedirect($this->router->pathFor('job:browse'));
        }

        $application->update([
            'status' => $args['status']
        ]);

        $this->flash->addMessage('success', 'Application Updated Successfully');

        return $response->withRedirect($this->router->pathFor('job:browse'));
    }
    
}