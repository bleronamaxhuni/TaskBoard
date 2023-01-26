function toggleModal() {
    document.getElementById('modal').classList.toggle('hidden')
  }

  function deleteFunction() {
    if(!confirm("Are You Sure to delete this task ?"))
    event.preventDefault();
}