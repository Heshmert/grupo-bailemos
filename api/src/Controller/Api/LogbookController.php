<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Logbook Controller
 *
 * @property \App\Model\Table\LogbookTable $Logbook
 */
class LogbookController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Logbook->find()
            ->contain(['Programs', 'Users']);
        $logbook = $this->paginate($query);

        $this->set(compact('logbook'));
    }

    /**
     * View method
     *
     * @param string|null $id Logbook id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $logbook = $this->Logbook->get($id, contain: ['Programs', 'Users']);
        $this->set(compact('logbook'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logbook = $this->Logbook->newEmptyEntity();
        if ($this->request->is('post')) {
            $logbook = $this->Logbook->patchEntity($logbook, $this->request->getData());
            if ($this->Logbook->save($logbook)) {
                $this->Flash->success(__('The logbook has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The logbook could not be saved. Please, try again.'));
        }
        $programs = $this->Logbook->Programs->find('list', limit: 200)->all();
        $users = $this->Logbook->Users->find('list', limit: 200)->all();
        $this->set(compact('logbook', 'programs', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Logbook id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logbook = $this->Logbook->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $logbook = $this->Logbook->patchEntity($logbook, $this->request->getData());
            if ($this->Logbook->save($logbook)) {
                $this->Flash->success(__('The logbook has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The logbook could not be saved. Please, try again.'));
        }
        $programs = $this->Logbook->Programs->find('list', limit: 200)->all();
        $users = $this->Logbook->Users->find('list', limit: 200)->all();
        $this->set(compact('logbook', 'programs', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Logbook id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $logbook = $this->Logbook->get($id);
        if ($this->Logbook->delete($logbook)) {
            $this->Flash->success(__('The logbook has been deleted.'));
        } else {
            $this->Flash->error(__('The logbook could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
