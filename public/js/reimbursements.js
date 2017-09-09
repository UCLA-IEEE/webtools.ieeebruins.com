$(() => {
  $('.reimbursement-form').submit(function(e) {
    e.preventDefault()

    let reimbursementData = {
      name: $('input[name="name"]').val(),
      contact: $('input[name="contact"]').val(),
      reason: $('textarea[name="reason"]').val(),
      amount: $('input[name="amount"]').val()
    }

    $.ajax({ url: '/reimbursements', type: 'POST', data: reimbursementData }).done(res => {
      console.log(res)
    })
  })
})
