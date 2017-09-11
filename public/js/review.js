$(() => {
  $('.review-form').submit(e => {
    e.preventDefault()

    let reviewData = {
      id: $('input[name="id"]').val(),
      approve: $('select[name="approve"]').val(),
      fund: $('select[name="fund"]').val(),
      reimbursed: $('select[name="reimburse"]').val(),
      check: $('input[name="check"]').val()
    }

    $.ajax({ url: '/reimbursements/review', type: 'POST', data: reviewData }).done(res => {
      res = JSON.parse(res)
      $('.status-message').text(res.message)

      if (res.status === 'success') $('input').val('')
    })
  })

  $('input').focus(() => $('.status-message').text(''))

  $('.nuke-form').submit(e => {
    e.preventDefault()

    $.ajax({ url: '/reimbursements', type: 'DELETE' }).done(res => {
      res = JSON.parse(res)
      $('.nuke-message').text(res.message)
    })
  })
})
