<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Registrations Controller
 *
 * @property \App\Model\Table\RegistrationsTable $Registrations
 */
class RegistrationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Registrations->find()
            ->contain(['Programs', 'Students']);
        $registrations = $this->paginate($query);

        $this->set(compact('registrations'));
    }

    /**
     * View method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registration = $this->Registrations->get($id, contain: ['Programs', 'Students']);
        $this->set(compact('registration'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registration = $this->Registrations->newEmptyEntity();
        if ($this->request->is('post')) {
            $registration = $this->Registrations->patchEntity($registration, $this->request->getData());
            if ($this->Registrations->save($registration)) {
                $this->Flash->success(__('The registration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registration could not be saved. Please, try again.'));
        }
        $programs = $this->Registrations->Programs->find('list', limit: 200)->all();
        $students = $this->Registrations->Students->find('list', limit: 200)->all();
        $this->set(compact('registration', 'programs', 'students'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registration = $this->Registrations->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registration = $this->Registrations->patchEntity($registration, $this->request->getData());
            if ($this->Registrations->save($registration)) {
                $this->Flash->success(__('The registration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registration could not be saved. Please, try again.'));
        }
        $programs = $this->Registrations->Programs->find('list', limit: 200)->all();
        $students = $this->Registrations->Students->find('list', limit: 200)->all();
        $this->set(compact('registration', 'programs', 'students'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registration = $this->Registrations->get($id);
        if ($this->Registrations->delete($registration)) {
            $this->Flash->success(__('The registration has been deleted.'));
        } else {
            $this->Flash->error(__('The registration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
