<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include('verifica_login.php');
include('connect.php');

$usuariologado = $_SESSION['nome'] ?? '';
$admin = $_SESSION['master'] ?? '';

$mes = (int)($_POST['mes'] ?? date('m'));
$ano = (int)($_POST['ano'] ?? date('Y'));

$turno = $_POST['turno'] ?? '';

$ambienteselecionado = $_POST['ambiente'] ?? '';

$sqlamb = 'select * from al_ambiente';

if ($ambienteselecionado != '') {

    $sqlamb .= " where nome='" . $ambienteselecionado . "'";
}

$sqlamb .= ' order by nome';

$nomemes = [
    '',
    'Janeiro',
    'Fevereiro',
    'Março',
    'Abril',
    'Maio',
    'Junho',
    'Julho',
    'Agosto',
    'Setembro',
    'Outubro',
    'Novembro',
    'Dezembro'
];

$nometurno = [
    'M' => 'Matutino',
    'V' => 'Vespertino',
    'N' => 'Noturno'
];

$descricaomes = $nomemes[$mes] ?? '';

$descricaoturno = $nometurno[$turno] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/ageselect.css">

    <link rel="icon" type="image/png" href="assets/img/flaticon.png">

    <title>Agenda</title>

</head>

<body>

    <div class="page-container">

        <div class="content-box">

            <form method="POST">

                <div class="filter-row">

                    <div class="form-group">

                        <label>Mês</label>

                        <select
                            name="mes"
                            class="form-control custom-input custom-select"
                            required>

                            <?php

                            for ($i = 1; $i <= 12; $i++) {

                                $selected = ($mes == $i) ? 'selected' : '';

                                echo '<option value="' . $i . '" ' . $selected . '>' . $nomemes[$i] . '</option>';
                            }

                            ?>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Ano</label>

                        <select
                            name="ano"
                            class="form-control custom-input custom-select"
                            required>

                            <?php

                            $anoatual = date('Y');

                            for ($i = $anoatual; $i <= $anoatual + 1; $i++) {

                                $selected = ($ano == $i) ? 'selected' : '';

                                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                            }

                            ?>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Turno</label>

                        <select
                            name="turno"
                            class="form-control custom-input custom-select"
                            required>

                            <option value="M" <?= $turno == 'M' ? 'selected' : '' ?>>
                                Matutino
                            </option>

                            <option value="V" <?= $turno == 'V' ? 'selected' : '' ?>>
                                Vespertino
                            </option>

                            <option value="N" <?= $turno == 'N' ? 'selected' : '' ?>>
                                Noturno
                            </option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Ambiente</label>

                        <select
                            name="ambiente"
                            class="form-control custom-input custom-select">

                            <option value="">--</option>

                            <?php

                            $sqlal = 'select distinct nome from al_ambiente order by nome';
                            $resultsql = mysqli_query($con, $sqlal);

                            while ($row = mysqli_fetch_assoc($resultsql)) {

                                if ($ambienteselecionado == $row['nome']) {
                                    echo '<option value="' . $row['nome'] . '" selected>' . $row['nome'] . '</option>';
                                } else {
                                    echo '<option value="' . $row['nome'] . '">' . $row['nome'] . '</option>';
                                }
                            }

                            ?>

                        </select>

                    </div>

                </div>

                <div class="button-group">

                    <button type="submit" class="custom-btn">
                        Consultar
                    </button>

                    <a href="menu.php" class="custom-btn">
                        Menu
                    </a>

                    <a href="index.php" class="custom-btn">
                        Voltar
                    </a>

                </div>

            </form>

            <?php

            $resultamb = mysqli_query($con, $sqlamb);
            while ($ambiente = mysqli_fetch_assoc($resultamb)) {

                echo '<div class="environment-block">';

                echo '<h2 class="environment-title">';
                echo $ambiente['nome'];
                echo '</h2>';

                $primeiroDiaTimestamp = mktime(0, 0, 0, $mes, 1, $ano);

                $diasNoMes = date('t', $primeiroDiaTimestamp);

                $diaSemanaComeca = date('w', $primeiroDiaTimestamp);

                echo "<h3>";
                echo $descricaomes . " / " . $ano . " - " . $descricaoturno;
                echo "</h3>";

                echo "<div class='calendar-wrapper'>";

                echo "<table>";

                echo "
                <tr>
                    <th>Dom</th>
                    <th>Seg</th>
                    <th>Ter</th>
                    <th>Qua</th>
                    <th>Qui</th>
                    <th>Sex</th>
                    <th>Sáb</th>
                </tr>
                ";

                echo "<tr>";

                for ($i = 0; $i < $diaSemanaComeca; $i++) {

                    echo "<td></td>";
                }

                $diaAtual = 1;

                while ($diaAtual <= $diasNoMes) {

                    if (($diaSemanaComeca + $diaAtual - 1) % 7 == 0 && $diaAtual != 1) {
                        echo "</tr><tr>";
                    }

                    $classeHoje =
                        (
                            $diaAtual == date('j')
                            &&
                            $mes == date('n')
                            &&
                            $ano == date('Y')
                        )
                        ?
                        'hoje'
                        :
                        '';

                    $dataok = sprintf('%04d-%02d-%02d', $ano, $mes, $diaAtual);

                    $sqldia = 'select 
                            a.id,
                            a.obs,
                            u.nome usuario,
                            u.reduzido,
                            b.nome,
                            a.data,
                            a.turno
                            from al_agenda a
                            inner join al_ambiente b on b.id=a.idambiente
                            inner join al_usuario u on u.id=a.idusuario
                            where a.data = "' . $dataok . '"
                            and turno ="' . $turno . '"
                            and b.nome="' . $ambiente['nome'] . '"';

                    $resultsqldia = mysqli_query($con, $sqldia);

                    $campodia = mysqli_fetch_assoc($resultsqldia);

                    $classeAgendamento = '';

                    if ($campodia) {

                        if ($campodia['usuario'] == $usuariologado) {
                            $classeAgendamento = 'meu-agendamento';
                        } else {
                            $classeAgendamento = 'agendamento-outro';
                        }
                    }

                    $classeFinal = trim($classeHoje . ' ' . $classeAgendamento);
                    $usuarioagenda = $campodia['usuario'] ?? '';
                    $usuarioreduzido = $campodia['reduzido'] ?? '';
                    $obs = $campodia['obs'] ?? '';
                    $idagenda = $campodia['id'] ?? '';

                    echo '<td
                            class="' . $classeFinal . ' calendar-day"
                            data-usuario="' . htmlspecialchars($usuarioagenda) . '"
                            data-obs="' . htmlspecialchars($obs) . '"
                            data-data="' . $dataok . '"
                            data-id="' . $idagenda . '"
                            data-agendamento="' . ($campodia ? '1' : '0') . '"
                            data-meu="' . ($usuarioagenda == $usuariologado ? '1' : '0') . '"
                          >';

                    echo "<div class='day-number'>";
                    echo $diaAtual;

                    if ($campodia) {
                        echo '<p>' . $campodia['reduzido'] . '</p>';
                    }
                    echo "</div>";
                    echo "</td>";

                    $diaAtual++;
                }

                while (($diaSemanaComeca + $diaAtual - 1) % 7 != 0) {

                    echo "<td></td>";

                    $diaAtual++;
                }

                echo "</tr>";

                echo "</table>";

                echo "</div>";

                echo '<div class="calendar-legend">

                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #f7941e;"></span>
                            <span class="legend-text">Dia Atual</span>
                        </div>

                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #28A745;"></span>
                            <span class="legend-text">Seu Usuário</span>
                        </div>

                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #F4C542;"></span>
                            <span class="legend-text">Outros Usuários</span>
                        </div>

                        <div class="legend-item">
                            <span class="legend-color" style="background-color: #24549C;"></span>
                            <span class="legend-text">Feriado</span>
                        </div>

                    </div>';

                echo '</div>';
            }

            ?>

        </div>

    </div>

    <div class="modal-overlay" id="modalOverlay">

        <div class="custom-modal">

            <button class="modal-close" id="fecharModal">
                &times;
            </button>

            <div id="modalConteudo"></div>

        </div>

    </div>

    <script>
        const admin = <?php echo (int)$admin; ?>;
        const modalOverlay = document.getElementById('modalOverlay');
        const modalConteudo = document.getElementById('modalConteudo');
        const fecharModal = document.getElementById('fecharModal');

        document.querySelectorAll('.calendar-day').forEach(function(dia) {

            dia.addEventListener('click', function() {

                const usuario = this.dataset.usuario;
                const obs = this.dataset.obs;
                const data = this.dataset.data;
                const idagenda = this.dataset.id;
                const agendamento = this.dataset.agendamento;
                const meu = this.dataset.meu;

                let html = '';

                if (agendamento == '0') {

                    html += `
                        <div class="alert alert-warning fade show">

                            <h4>Nenhum agendamento</h4>
                            <hr>
                            <p>Deseja realizar um agendamento?</p>

                            <a href="ageinsert.php?data=${data}" class="custom-btn">
                                Agendar
                            </a>

                        </div>
                    `;

                    /*
                Usuário proprietário
                ou administrador
                */

                } else if (meu == '1' || admin == 1) {

                    html += `
                        <div class="alert alert-warning fade show">

                            <h4>${meu == '1' ? 'Seu Agendamento' : 'Agendamento'}</h4>
                            <hr>
                            <p><strong>Usuário:</strong> ${usuario}</p>
                            <p><strong>Observação:</strong> ${obs}</p>

                            <div class="modal-buttons">

                                <a href="ageupdate.php?updateid=${idagenda}" class="custom-btn">
                                    Editar
                                </a>

                                <a href="agedelete.php?deleteid=${idagenda}" class="custom-btn">
                                    Excluir
                                </a>

                            </div>

                        </div>
                    `;

                } else {

                    html += `
                        <div class="alert alert-warning fade show">
                            <h4>Agendamento</h4>
                            <hr>
                            <p><strong>Usuário:</strong> ${usuario}</p>
                            <p><strong>Observação:</strong> ${obs}</p>

                        </div>
                    `;
                }

                modalConteudo.innerHTML = html;
                modalOverlay.style.display = 'flex';

            });

        });

        fecharModal.addEventListener('click', function() {
            modalOverlay.style.display = 'none';

        });

        modalOverlay.addEventListener('click', function(e) {

            if (e.target === modalOverlay) {
                modalOverlay.style.display = 'none';
            }

        });
    </script>

</body>

</html>