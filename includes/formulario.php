<main>
    <section>
        <a href="index.php">
            <button class="btn btn-success mt-4"> Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="post">
        <div class="form-group">
            <label for="titulo">Titulo</label>
            <input type="text" class="form-control" name="titulo" value="<?=$obVaga->titulo?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea rows="5" type="text" class="form-control" name="descricao"><?=$obVaga->descricao?></textarea> 
        </div>

        <div class="form-group">
            <label for="descricao">Status</label>

            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="s" checked> Ativo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="n" <?=$obVaga->ativo == 'n' ? 'checked' : '' ?> > Inativo
                    </label>
                </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success"> Enviar</button>
        </div>

    </form>
</main>