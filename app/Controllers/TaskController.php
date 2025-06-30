<?php

namespace App\Controllers;

use App\Models\Task;
use App\Models\Category;

class TaskController extends BaseController
{
    protected $taskModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->taskModel = new Task();
        $this->categoryModel = new Category();
    }

    private function checkLogin()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->send(); // Force immediate redirect
        }
    }

    public function index()
    {
        $this->checkLogin();

        $status = $this->request->getGet('status') ?? 'all';
        $userId = session()->get('user_id');

        $query = $this->taskModel->where('user_id', $userId);
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $data = [
            'tasks' => $query->findAll(),
            'categories' => $this->categoryModel->findAll(),
            'status' => $status,
        ];
        return view('tasks/index', $data);
    }

    public function create()
    {
        $this->checkLogin();

        if ($this->request->is('post')) {
            $rules = [
                'title' => 'required|min_length[3]|max_length[255]',
                'category_id' => 'required|numeric',
                'description' => 'permit_empty',
            ];
            if ($this->validate($rules)) {
                $this->taskModel->save([
                    'user_id' => session()->get('user_id'),
                    'category_id' => $this->request->getPost('category_id'),
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                return redirect()->to('/tasks')->with('success', 'Task added successfully.');
            } else {
                $data['validation'] = $this->validator;
                $data['categories'] = $this->categoryModel->findAll();
                return view('tasks/create', $data);
            }
        }
        $data['categories'] = $this->categoryModel->findAll();
        return view('tasks/create', $data);
    }

    public function edit($id)
    {
        $this->checkLogin();

        $task = $this->taskModel->where('user_id', session()->get('user_id'))->find($id);
        if (!$task) {
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }

        if ($this->request->is('post')) {
            $rules = [
                'title' => 'required|min_length[3]|max_length[255]',
                'category_id' => 'required|numeric',
                'description' => 'permit_empty',
            ];
            if ($this->validate($rules)) {
                $this->taskModel->update($id, [
                    'category_id' => $this->request->getPost('category_id'),
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                return redirect()->to('/tasks')->with('success', 'Task updated successfully.');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        $data['task'] = $task;
        $data['categories'] = $this->categoryModel->findAll();
        return view('tasks/edit', $data);
    }

    public function delete($id)
    {
        $this->checkLogin();

        $task = $this->taskModel->where('user_id', session()->get('user_id'))->find($id);
        if ($task) {
            $this->taskModel->delete($id);
            return redirect()->to('/tasks')->with('success', 'Task deleted successfully.');
        }
        return redirect()->to('/tasks')->with('error', 'Task not found.');
    }

    public function toggleStatus($id)
    {
        $this->checkLogin();

        $task = $this->taskModel->where('user_id', session()->get('user_id'))->find($id);
        if ($task) {
            $newStatus = $task['status'] === 'pending' ? 'completed' : 'pending';
            $this->taskModel->update($id, [
                'status' => $newStatus,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->to('/tasks')->with('success', 'Task status updated.');
        }
        return redirect()->to('/tasks')->with('error', 'Task not found.');
    }
}
