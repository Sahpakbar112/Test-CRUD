<?php
//kode User.php
class User extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Role_model');
    $this->load->helper(['form', 'url']);
    $this->load->library(['form_validation', 'upload']);
    
  }
//get data
public function index()
{
    $this->load->model('User_model');
    $data['users'] = $this->User_model->get_all(); // data  terfilter
    $this->load->view('user/index', $data);
}

  public function fetch()
  {
      $this->load->model('User_model');
      $users = $this->User_model->get_all(); // sudah terfilter
      echo json_encode($users);
  }
  

//tambah data
public function add() {
  $this->form_validation->set_rules('name', 'Name', 'required');
  $this->form_validation->set_rules('phone', 'Phone', 'required');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
  $this->form_validation->set_rules('address', 'Address', 'required');
  $this->form_validation->set_rules('role_id', 'Role', 'required');

  if ($this->form_validation->run() == FALSE) {
      $data['roles'] = $this->Role_model->get_all();
      $this->load->view('user/user_add', $data);
  } else {
      $photo = null;
      $upload = $this->_upload_photo();

      if ($upload) {
          $photo = $upload['file_name'];
      } else if (!empty($_FILES['photo']['name'])) {
          $this->session->set_flashdata('error', $this->upload->display_errors());
          redirect('user/add');
      }

      // Data yang akan disimpan ke database
      $saveData = [
          'name' => $this->input->post('name', TRUE),
          'phone' => $this->input->post('phone', TRUE),
          'email' => $this->input->post('email', TRUE),
          'address' => $this->input->post('address', TRUE),
          'role_id' => $this->input->post('role_id'),
          'photo' => $photo,
          'is_active' => 1
      ];

      $this->User_model->save($saveData);

      // Data untuk view sukses
      $viewData['message'] = 'Data pengguna berhasil ditambahkan.';
      $this->load->view('user/user_success', $viewData);
  }
}


public function save()
{
    $this->load->model('user_model');

    $data = [
        'name'      => $this->input->post('name'),
        'email'     => $this->input->post('email'),
        'phone'     => $this->input->post('phone'),
        'address'   => $this->input->post('address'),
        'role_id'   => $this->input->post('role_id'),
        'is_active' => $this->input->post('is_active'),
        'photo'     => null 
    ];

    $this->form_validation->set_rules('name', 'Nama', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if ($this->form_validation->run()) {
        $inserted = $this->user_model->insert($data);
        echo json_encode(['status' => $inserted]);
    } else {
        echo json_encode([
            'status' => false,
            'errors' => validation_errors()
        ]);
    }
}
//Edit data
  public function edit($id)
  {
      $data['user'] = $this->User_model->getById($id);
      $data['roles'] = $this->User_model->get_roles(); 
  
      if (!$data['user']) {
          show_404();
      }
  
      $this->load->view('user/user_edit', $data);
  }
  
  public function update()
  {
      $id = $this->input->post('id');
      $data = [
          'role_id' => $this->input->post('role_id'),
          'name' => $this->input->post('name'),
          'email' => $this->input->post('email'),
          'phone' => $this->input->post('phone'),
          'address' => $this->input->post('address'),
          'updated_at' => date('Y-m-d H:i:s')
      ];
  
      // Coba upload foto jika ada
      $upload_data = $this->_upload_photo();
      if ($upload_data) {
          // Hapus foto lama
          $old_photo = $this->User_model->getById($id)->photo;
          if ($old_photo && file_exists(FCPATH . 'assets/uploads/users/' . $old_photo)) {
              unlink(FCPATH . 'assets/uploads/users/' . $old_photo);
          }
  
          // Simpan nama file foto baru
          $data['photo'] = $upload_data['file_name'];
      }
  
      $this->User_model->update($id, $data);
      $this->session->set_flashdata('success', 'Data user berhasil diupdate.');
      redirect('user');
  }
  
  public function detail($id)
{
    $this->load->model('User_model');
    $user = $this->User_model->get_by_id($id);

    if (!$user) {
        show_404();
    }

    $data['user'] = $user;
    $this->load->view('user/detail', $data); // arahkan ke view detail
}

// //delete permanen
//   public function delete($id)
//   {
//       $this->load->model('User_model');
//       $result = $this->User_model->delete($id);
  
//       if ($result) {
//           echo json_encode(['status' => true, 'message' => 'User berhasil dihapus.']);
//       } else {
//           echo json_encode(['status' => false, 'message' => 'Gagal menghapus user.']);
//       }
//   }
  

//soft delete
public function delete($id)
{
    $this->load->model('User_model');
    $result = $this->User_model->soft_delete($id);

    if ($result) {
        echo json_encode(['status' => true, 'message' => 'User berhasil dihapus.']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Gagal menghapus user.']);
    }
}


  private function _validate() {
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('role_id', 'Role', 'required');
    if (!$this->form_validation->run()) {
      echo json_encode(['status' => false, 'errors' => validation_errors()]);
      exit;
    }
  }
  //fun add 
  private function _uploads_photo() {
    if (!empty($_FILES['photo']['name'])) {
      $config['upload_path'] = './assets/uploads/users/';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['max_size'] = 9048;
      $this->upload->initialize($config);
      if ($this->upload->do_upload('photo')) {
        return $this->upload->data();
      }
    }
    return null;
  }
  //fun edit
  private function _upload_photo() {
    if (!empty($_FILES['photo']['name'])) {
      $config['upload_path'] = './assets/uploads/users/';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['max_size'] = 9048;
      $this->upload->initialize($config);
      if ($this->upload->do_upload('photo')) {
        return $this->upload->data();
      }
    }
    return null;
  }
  public function toggle_active($id)
    {
        $this->load->model('User_model');
        $user = $this->User_model->getById($id);

        if (!$user) {
            echo json_encode(['status' => false, 'message' => 'User tidak ditemukan.']);
            return;
        }

        $new_status = $user->is_active ? 0 : 1;
        $this->User_model->update($id, ['is_active' => $new_status]);

        echo json_encode(['status' => true, 'message' => 'Status user berhasil diperbarui.']);
    }
  

}