function deleteTodo(endpoint) {
    axios.delete(endpoint)
        .then((response) => {
            alertMsg('Deleted successfully', 'Alert', 'success')
            console.log(response)
            setTimeout(() => {
                window.location.reload()
            }, 100)
        }).catch((err) => {
            alertMsg('An error occured', 'Error Alert', 'error')
            console.log(err)
        })
}

function completedTodo(endpoint) {
    axios.post(endpoint)
        .then((response) => {
            alertMsg('Completed successfully', 'Alert', 'success')
            console.log(response)
            setTimeout(() => {
                window.location.reload()
            }, 100)
        }).catch((err) => {
            alertMsg('An error occured', 'Error Alert', 'error')
            console.log(err)
        })
}

function updateTodo(endpoint) {
    axios.put(endpoint, {
        'name': document.querySelector('#todo-name').value,
        'description': document.querySelector('#todo-desc').value,
    }).then((response) => {
        alertMsg('Updated successfully', 'Alert', 'success')
        console.log(response)
        setTimeout(() => {
            window.location.reload()
        }, 100)
    }).catch((err) => {
        alertMsg('An error occured', 'Error Alert', 'error')
        console.log(err)
    })
}
function addTodo(endpoint, id) {
    axios.post(endpoint, {
        'name': document.querySelector('#add-todo-name').value,
        'description': document.querySelector('#add-todo-desc').value,
        'user_id': id,
    }).then((response) => {
        alertMsg('Added successfully', 'Alert', 'success')
        console.log(response)
        setTimeout(() => {
            window.location.reload()
        }, 100)
    }).catch((err) => {
        alertMsg('An error occured', 'Error Alert', 'error')
        console.log(err)
    })
}

