<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Contracts Controller
 *
 * @property \App\Model\Table\ContractsTable $Contracts
 */
class ContractsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Contracts->find()
            ->contain(['Users', 'Positions']);
        $contracts = $this->paginate($query);

        $this->set(compact('contracts'));
    }

    /**
     * View method
     *
     * @param string|null $id Contract id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contract = $this->Contracts->get($id, contain: ['Users', 'Positions', 'Programs']);
        $this->set(compact('contract'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contract = $this->Contracts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contract = $this->Contracts->patchEntity($contract, $this->request->getData());
            if ($this->Contracts->save($contract)) {
                $this->Flash->success(__('The contract has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contract could not be saved. Please, try again.'));
        }
        $users = $this->Contracts->Users->find('list', limit: 200)->all();
        $positions = $this->Contracts->Positions->find('list', limit: 200)->all();
        $this->set(compact('contract', 'users', 'positions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contract id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contract = $this->Contracts->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contract = $this->Contracts->patchEntity($contract, $this->request->getData());
            if ($this->Contracts->save($contract)) {
                $this->Flash->success(__('The contract has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contract could not be saved. Please, try again.'));
        }
        $users = $this->Contracts->Users->find('list', limit: 200)->all();
        $positions = $this->Contracts->Positions->find('list', limit: 200)->all();
        $this->set(compact('contract', 'users', 'positions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contract id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contract = $this->Contracts->get($id);
        if ($this->Contracts->delete($contract)) {
            $this->Flash->success(__('The contract has been deleted.'));
        } else {
            $this->Flash->error(__('The contract could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
