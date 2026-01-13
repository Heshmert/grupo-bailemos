<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Contents Controller
 *
 * @property \App\Model\Table\ContentsTable $Contents
 */
class ContentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Contents->find()
            ->contain(['Programs']);
        $contents = $this->paginate($query);

        $this->set(compact('contents'));
    }

    /**
     * View method
     *
     * @param string|null $id Content id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $content = $this->Contents->get($id, contain: ['Programs', 'AcademicProgress', 'Lessons']);
        $this->set(compact('content'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $content = $this->Contents->newEmptyEntity();
        if ($this->request->is('post')) {
            $content = $this->Contents->patchEntity($content, $this->request->getData());
            if ($this->Contents->save($content)) {
                $this->Flash->success(__('The content has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The content could not be saved. Please, try again.'));
        }
        $programs = $this->Contents->Programs->find('list', limit: 200)->all();
        $this->set(compact('content', 'programs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Content id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $content = $this->Contents->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $content = $this->Contents->patchEntity($content, $this->request->getData());
            if ($this->Contents->save($content)) {
                $this->Flash->success(__('The content has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The content could not be saved. Please, try again.'));
        }
        $programs = $this->Contents->Programs->find('list', limit: 200)->all();
        $this->set(compact('content', 'programs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Content id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $content = $this->Contents->get($id);
        if ($this->Contents->delete($content)) {
            $this->Flash->success(__('The content has been deleted.'));
        } else {
            $this->Flash->error(__('The content could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
