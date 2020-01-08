require( 'datatables.net-bs4' );

const tableElement = document.querySelector('#table');

if (tableElement)  {
   $(tableElement).DataTable();

   document.addEventListener('click', function(event) {
      if (event.target.classList.contains('js-toggle-button')) {
         const button = event.target;
         const pre = button.nextElementSibling
         if (pre.classList.contains('d-none')) {
            pre.classList.remove('d-none');
            button.innerText = 'Hide';
         }
         else {
            pre.classList.add('d-none');
            button.innerText = 'Display';
         }
      }
   })
}

