$(() => {
  let filterValue = getParameterByName('filter') ? getParameterByName('filter') : 'pending'
  $('select[name="filter"] option[value="' + getParameterByName('filter') + '"]').attr('selected', 'selected')

  $('.approval-filter').submit(e => {
    e.preventDefault()

    let choice = $('select[name="filter"]').val()
    location.href = '/reimbursements/browse/?filter=' + choice
  })
})

function getParameterByName(name, url) {
  if (!url) url = window.location.href
  name = name.replace(/[\[\]]/g, '\\$&')
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
    results = regex.exec(url)
  if (!results) return null
  if (!results[2]) return ''
  return decodeURIComponent(results[2].replace(/\+/g, ' '))
}
