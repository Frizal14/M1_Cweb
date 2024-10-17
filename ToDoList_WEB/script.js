let todoList = document.getElementById('todo-list');
let todoInput = document.getElementById('todo-input');

// Fungsi untuk menambahkan tugas baru
function addTask() {
  const taskText = todoInput.value.trim();
  if (taskText === '') return; // Cegah input kosong

  const li = document.createElement('li'); // Elemen list item

  // Input untuk teks tugas
  const taskInput = document.createElement('input');
  taskInput.type = 'text';
  taskInput.value = taskText;
  taskInput.setAttribute('readonly', 'readonly'); // Input tidak bisa diedit default-nya

  // Container untuk tombol di bawah teks tugas
  const buttonContainer = document.createElement('div');
  buttonContainer.classList.add('button-container');

  // Tombol Edit
  const editBtn = document.createElement('button');
  editBtn.innerText = 'Edit';
  editBtn.classList.add('edit-btn');
  editBtn.onclick = () => {
    if (taskInput.hasAttribute('readonly')) {
      taskInput.removeAttribute('readonly'); // Ubah menjadi editable
      editBtn.innerText = 'Save';
    } else {
      taskInput.setAttribute('readonly', 'readonly'); // Kunci kembali
      editBtn.innerText = 'Edit';
    }
  };

  // Tombol Delete
  const deleteBtn = document.createElement('button');
  deleteBtn.innerText = 'Delete';
  deleteBtn.classList.add('delete-btn');
  deleteBtn.onclick = () => todoList.removeChild(li); // Hapus tugas

  // Tambahkan tombol ke dalam container
  buttonContainer.appendChild(editBtn);
  buttonContainer.appendChild(deleteBtn);

  // Tambahkan input dan tombol ke elemen list item
  li.appendChild(taskInput);
  li.appendChild(buttonContainer);

  // Tambahkan elemen list item ke daftar to-do
  todoList.appendChild(li);

  // Reset input setelah menambah tugas
  todoInput.value = '';
}
