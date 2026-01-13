<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Firebase\JWT\JWT;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

   // in src/Controller/UsersController.php
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'add']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

public function login()
{
    $this->request->allowMethod(['post']);
    $data = $this->request->getData(); // Aquí llegan el email y password de Astro

    // 1. Buscamos al usuario en la DB por su email
    $user = $this->fetchTable('Users')
        ->find()
        ->where(['email' => $data['email']])
        ->first();

    // 2. Verificamos si existe y si la contraseña coincide
    // Nota: Si usas DefaultPasswordHasher, Cake lo hace así:
    if ($user && (new \Authentication\PasswordHasher\DefaultPasswordHasher())->check($data['password'], $user->password)) {
        
        $payload = [
            'iss' => 'myapp',
            'sub' => $user->id,
            'exp' => time() + 60 * 60 * 24,
        ];

        $json = [
            'success' => true,
            'token' => \Firebase\JWT\JWT::encode($payload, 'ClaveSuperSecretaDePrueba1234567890', 'HS256'),
            'fullname' => $user->name1 . ' ' . $user->lastname1,
            'role' => $user->role
        ];
    } else {
        $this->response = $this->response->withStatus(401);
        $json = ['success' => false, 'error' => 'Usuario o contraseña incorrectos'];
    }

    return $this->response
        ->withType('application/json')
        ->withStringBody(json_encode($json));
}

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: ['Contracts', 'Logbook']);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->set([
                    'success' => true,
                    'user' => $user,
                    '_serialize' => ['success', 'user']
                ]);
                return;
            }
        }

        $this->set([
            'success' => false,
            'errors' => $user->getErrors(),
            '_serialize' => ['success', 'errors']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
