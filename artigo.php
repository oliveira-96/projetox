<?php
// Pega o id da URL.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!empty($id)) {
    // Busca artigo.
    $query = mysqli_query($db, "SELECT *, (FROM categoria FROM categorias WHERE id = artigos.categoria_id) AS categoria FROM artigos WHERE status = 1 AND id = {$id}");
    if (mysqli_num_rows($query)) {
        $item = mysqli_fetch_assoc($query);

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
    } else {
        ?>
        <script>window.location = '?m=404';</script>
        <?php
    }
} else {
    // Erro 404.
    ?>
    <script>window.location = '?m=404';</script>
    <?php
}
?>

<!-- Blog entry -->
<div class="w3-card-4 w3-margin w3-white">
    <img src="<?= $item['imagem']; ?>" alt="<?= $item['titulo']; ?>" style="width:100%">
    <div class="w3-container">
        <h3><b>
                <?= $item['titulo']; ?>
            </b></h3>
        <h5>
            <?= $item['categoria']; ?> - <span class="w3-opacity">
                <?= date('d/m/Y, H:i\h', strtotime($item['criado_em'])); ?>
            </span>
        </h5>
    </div>

    <div class="w3-container">
        <p>
            <? $item['conteudo'] ?>
        </p>
        <div class="w3-row">
            <div class="w3-col m8 s12">
                <p>
                    <a href="?m=home"><button class="w3-button w3-padding-large w3-white w3-border"><b>VOLTAR
                                »</b></button></a>
                </p>
            </div>
            <div class="w3-col m4 w3-hide-small">
                <p>
                    <span class="w3-padding-large w3-right">
                        <b>Atualizado em  </b>
                        <span class="w3-tag">
                            <? if (empty($item['alterado_em'])) {
                                echo date('d/m/Y, H:i\h', strtotime($item['criado_em']));
                            } else {
                                echo date('d/m/Y', strtotime($item['alterado_em']));
                            }
                            ?>
                        </span>
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
<hr>