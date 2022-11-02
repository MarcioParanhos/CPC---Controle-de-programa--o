<?php

include("./layouts/header.php")

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">RELATORIO DE CARÊNCIA</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Relatorios</li>
            <li class="breadcrumb-item active" aria-current="page">Carência</li>
        </ol>
    </div>
    <!--Row-->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="forms-sample" action="#" method="post">
                                                <div class="form-row">
                                                    <div class="position-relative col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label" for="disciplina_id">NTE</label>
                                                            <select name="motivo_vaga" id="motivo_vaga" class="form-control form-control-sm" required>
                                                                <option value="" selected>Selecione ...</option>
                                                                    <option value="01">01</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label" for="disciplina_id">Municipio</label>
                                                            <select name="motivo_vaga" id="motivo_vaga" class="form-control form-control-sm" required>
                                                                <option value="" selected>Selecione ...</option>
                                                                    <option value="01">AMÉRICA DOURADA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label" for="disciplina_id">Unidade Escolar</label>
                                                            <select name="motivo_vaga" id="motivo_vaga" class="form-control form-control-sm" required>
                                                                <option value="" selected>Selecione ...</option>
                                                                    <option value="01">COLEGIO ESTADUAL SÃO SEBASTIÃO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label" for="disciplina_id">Tipo de Carência</label>
                                                            <select name="motivo_vaga" id="motivo_vaga" class="form-control form-control-sm" required>
                                                                <option value="" selected>Selecione ...</option>
                                                                    <option value="01">Real</option>
                                                                    <option value="01">Temporária</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label" for="disciplina_id">Vinculo</label>
                                                            <select name="motivo_vaga" id="motivo_vaga" class="form-control form-control-sm" required>
                                                                <option value="" selected>Selecione ...</option>
                                                                    <option value="01">Estatutario</option>
                                                                    <option value="01">Reda</option>
                                                                    <option value="01">Ambos</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label" for="disciplina_id">Disciplina</label>
                                                            <select name="motivo_vaga" id="motivo_vaga" class="form-control form-control-sm" required>
                                                                <option value="" selected>Selecione ...</option>
                                                                    <option value="01">MATEMATICA</option>
                                                                    <option value="01">FISICA</option>
                                                                    <option value="01">PORTUGUÊS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a title="Buscar"><button type="submit" class=" float-right btn btn-lg bg-purple btn-primary  mr-2"><i class="fa-solid fa-search"></i></i></button></a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    <!--Row-->
</div>
<!---Fim do Conteudo da Pagina-->
<?php

include("layouts/footer.php")

?>