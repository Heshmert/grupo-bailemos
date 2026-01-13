<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * AcademicProgress Controller
 *
 * @property \App\Model\Table\AcademicProgressTable $AcademicProgress
 */
class AcademicProgressController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->AcademicProgress->find()
            ->contain(['Students', 'Contents', 'Lessons']);
        $academicProgress = $this->paginate($query);

        $this->set(compact('academicProgress'));
    }

    /**
     * View method
     *
     * @param string|null $id Academic Progres id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $academicProgres = $this->AcademicProgress->get($id, contain: ['Students', 'Contents', 'Lessons']);
        $this->set(compact('academicProgres'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $academicProgres = $this->AcademicProgress->newEmptyEntity();
        if ($this->request->is('post')) {
            $academicProgres = $this->AcademicProgress->patchEntity($academicProgres, $this->request->getData());
            if ($this->AcademicProgress->save($academicProgres)) {
                $this->Flash->success(__('The academic progres has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The academic progres could not be saved. Please, try again.'));
        }
        $students = $this->AcademicProgress->Students->find('list', limit: 200)->all();
        $contents = $this->AcademicProgress->Contents->find('list', limit: 200)->all();
        $lessons = $this->AcademicProgress->Lessons->find('list', limit: 200)->all();
        $this->set(compact('academicProgres', 'students', 'contents', 'lessons'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Academic Progres id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $academicProgres = $this->AcademicProgress->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $academicProgres = $this->AcademicProgress->patchEntity($academicProgres, $this->request->getData());
            if ($this->AcademicProgress->save($academicProgres)) {
                $this->Flash->success(__('The academic progres has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The academic progres could not be saved. Please, try again.'));
        }
        $students = $this->AcademicProgress->Students->find('list', limit: 200)->all();
        $contents = $this->AcademicProgress->Contents->find('list', limit: 200)->all();
        $lessons = $this->AcademicProgress->Lessons->find('list', limit: 200)->all();
        $this->set(compact('academicProgres', 'students', 'contents', 'lessons'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Academic Progres id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $academicProgres = $this->AcademicProgress->get($id);
        if ($this->AcademicProgress->delete($academicProgres)) {
            $this->Flash->success(__('The academic progres has been deleted.'));
        } else {
            $this->Flash->error(__('The academic progres could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
