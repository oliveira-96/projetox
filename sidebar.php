<!-- About Card -->
<div class="w3-card w3-margin w3-margin-top">
    <img src="assets/autor.jpg" style="width:100%">
    <div class="w3-container w3-white">
        <h4><b>
                <?= BLOG_AUTOR; ?>
            </b></h4>
        <p>
            <?= BLOG_SOBRE; ?>
        </p>
    </div>
</div>
<hr>

<!-- Posts -->
<div class="w3-card w3-margin">
    <div class="w3-container w3-padding">
        <h4>Artigos recentes</h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">
        <?php
        // Monta e executa query.
        $query = mysqli_query($db, "SELECT *, (SELECT categoria FROM categorias WHERE id = artigos.categoria_id) AS categoria FROM artigos ORDER BY id DESC LIMIT 5");

        // Verefica se existem resultados para a query.
        if (mysqli_num_rows($query)) {
            //Itera os resultados
            while ($item = mysqli_fetch_assoc($query)) {

                //Verifica e ajusta o caminho da imagem.
                if (empty($item['imagem'])) {
                    // Define a imagem default.
                    $item['imagem'] = 'assets/sem-imagem.jpg';
                } else {
                    // Verifica a existência do arquivo físico.
                    if (!file_exists('cms/uploads/' . $item['imagem'])) {
                        // Define a imagem default.
                        $item['imagem'] = 'assets/sem-imagem.jpg';
                    } else {
                        // Ajusta caminho da imagem.
                        $item['imagem'] = 'cms/uploads/' . $item['imagem'];
                    }
                }
                ?>
                <li class="w3-padding-16">
                    <a href="?m=artigo&id=<?= $item['id']; ?>" style="text-decoration: none;">
                        <img src="<?= $item['imagem']; ?>" alt="<?= $item['titulo']; ?>" class="w3-left w3-margin-right"
                            style="width:50px">
                        <span class="w3-large">
                            <?= $item['titulo']; ?>
                        </span><br>
                        <span>
                            <?= date('d/m/Y, H:i\h', strtotime($item['criado_em'])); ?>
                        </span>
                    </a>
                </li>
                <?php
            }
        } else {
            ?>
            <p>Nenhum conteúdo por aqui...</p>
        <?
        }
        ?>
    </ul>
</div>
<hr>

<!-- Labels / tags -->
<div class="w3-card w3-margin">
    <div class="w3-container w3-padding">
        <h4>Categorias</h4>
    </div>
    <div class="w3-container w3-white">
        <p>
            <?php
            $query = mysqli_query($db, "SELECT id, categoria FROM categorias WHERE status = 1");
            if (mysqli_num_rows($query)) {
                while ($item = mysqli_fetch_assoc($query)) {
                    ?>
                    <span
                        class="w3-tag <?=(!empty($c) && $c == $item['id'] ? 'w3-black' : 'w3-light-grey'); ?> w3-margin-bottom">
                        <a href="?c=<?= $item['id']; ?>"><?= $item['categoria']; ?></a>
                    </span>
                    <?php
                }
            } else {
                echo 'Nenhum conteúdo disponível...';
            }
            ?>
        </p>
    </div>
</div>