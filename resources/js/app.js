import './bootstrap';
import Alpine from 'alpinejs';
import DataTable from 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    new DataTable('#productos', {
        dom: 'Bfrtip',
        paging: true,
        pageLength: 10,
        ordering: true,
        searching: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });
});
