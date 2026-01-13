<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 */
class SchedulesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Schedules->find()
            ->contain(['Programs']);
        $schedules = $this->paginate($query);

        $this->set(compact('schedules'));
    }

    /**
     * View method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, contain: ['Programs', 'Lessons']);
        $this->set(compact('schedule'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schedule = $this->Schedules->newEmptyEntity();
        if ($this->request->is('post')) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->getData());
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
        }
        $programs = $this->Schedules->Programs->find('list', limit: 200)->all();
        $this->set(compact('schedule', 'programs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schedule = $this->Schedules->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->getData());
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
        }
        $programs = $this->Schedules->Programs->find('list', limit: 200)->all();
        $this->set(compact('schedule', 'programs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->Schedules->get($id);
        if ($this->Schedules->delete($schedule)) {
            $this->Flash->success(__('The schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
