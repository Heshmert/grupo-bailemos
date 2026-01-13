<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Representatives Controller
 *
 * @property \App\Model\Table\RepresentativesTable $Representatives
 */
class RepresentativesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Representatives->find();
        $representatives = $this->paginate($query);

        $this->set(compact('representatives'));
    }

    /**
     * View method
     *
     * @param string|null $id Representative id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $representative = $this->Representatives->get($id, contain: ['Students']);
        $this->set(compact('representative'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $representative = $this->Representatives->newEmptyEntity();
        if ($this->request->is('post')) {
            $representative = $this->Representatives->patchEntity($representative, $this->request->getData());
            if ($this->Representatives->save($representative)) {
                $this->Flash->success(__('The representative has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The representative could not be saved. Please, try again.'));
        }
        $this->set(compact('representative'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Representative id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $representative = $this->Representatives->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $representative = $this->Representatives->patchEntity($representative, $this->request->getData());
            if ($this->Representatives->save($representative)) {
                $this->Flash->success(__('The representative has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The representative could not be saved. Please, try again.'));
        }
        $this->set(compact('representative'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Representative id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $representative = $this->Representatives->get($id);
        if ($this->Representatives->delete($representative)) {
            $this->Flash->success(__('The representative has been deleted.'));
        } else {
            $this->Flash->error(__('The representative could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
