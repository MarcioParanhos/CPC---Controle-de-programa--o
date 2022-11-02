<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelLogout">Ohh Não!</h5>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja sair?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <a href="./config/auth.php" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>copyright &copy;
                <!-- Script que pega o ano atual -->
                <script>
                    document.write(new Date().getFullYear());
                </script> - developed by
                <b><a href="https://marcioparanhos.github.io/Portifolio/" target="_blank">Marcio Paranhos</a></b>
            </span>
        </div>
    </div>
</footer>
<!-- Footer -->
</div>
</div>
<!-- Voltar ao TOP -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa-solid fa-angles-up"></i>
</a>
<!-- scripts do sistema -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/app.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<!-- DataTables das tabelas -->
<script>
   $(document).ready(function() {
    $('#myTable').DataTable({
        ordering: false, //Oculta a ordem da tabela
        paging: false, //Oculta a quantidade de registros por pagina
        info: false, // Oculta informação de numeros por pagina
        lengthMenu: [ //Quantidade de registros por paginas
            [-1, 10, 25, 50, 100],
            ['Todos', 10, 25, 50, 100],
        ],
        language: { // Tradução do DataTables
            lengthMenu: 'Exibindo _MENU_ Registros por página',
            zeroRecords: 'Nada encontrado! desculpe =(',
            info: 'Mostrando Pagina _PAGE_ de _PAGES_',
            infoEmpty: 'Não há registros disponíveis',
            infoFiltered: '(filtrado de _MAX_ registros totais)',
            sSearch: "Buscar",
            oPaginate: {
                sFirst: "Primeira",
                sNext: "Próxima",
                sPrevious: "Anterior",
                sLast: "Última",
            }
        },
    });
});
</script>

</body>

</html>