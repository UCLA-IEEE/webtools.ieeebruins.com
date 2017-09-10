$(() => {
  $('.reimbursement-form').submit(e => {
    e.preventDefault()

    $('.reimbursement-form').ajaxSubmit({
      success: res => handleFormResponse(res)
    })
  })

  $('input, textarea').focus(() => $('.status-message').text(''))
})

function handleFormResponse(res) {
  res = JSON.parse(res)

  if (res.status === 'success') $('input, textarea').val('')
  changeStatusMessage(res.message)
}

function changeStatusMessage(message) {
  $('.status-message').text(message)
}
