<?php
// Obtenha o endereço IP do servidor
$server_ip = gethostbyname($_SERVER['SERVER_NAME']);

// Verifique se o endereço IP do servidor não é um IP local
if (!in_array($server_ip, array('127.0.0.1', '::1', 'localhost'))) {
    // Verifique se estamos em HTTP e redirecione para HTTPS
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
        $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        exit();
    }

    // Remova o "www." se estiver presente
    if (substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.') {
        $url = 'https://' . substr($_SERVER['HTTP_HOST'], 4) . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        exit();
    }
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['token'])) {
        if ($_POST['token'] == $_SESSION['token']) {
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $mensagem = $_POST["mensagem"];

            // Configuração de email
//            $destinatario = "contato@flaviopavim.com.br"; // Substitua pelo seu endereço de email
            $destinatario = "kickonightmare@gmail.com"; // Substitua pelo seu endereço de email
            $assunto = "Mensagem no site WhiteHats";
            $headers = "From: $email";

            // Corpo da mensagem
            $mensagem_email = "Nome: $nome\n";
            $mensagem_email .= "Email: $email\n\n";
            $mensagem_email .= "Mensagem:\n$mensagem";

            // Envie o email
            $envio = mail($destinatario, $assunto, $mensagem_email, $headers);

            if ($envio) {
                echo "<script>alert('Mensagem enviada com sucesso. Obrigado por entrar em contato!'); window.location.href = './';</script>";
            } else {
                echo "<script>alert('Ocorreu um erro ao enviar a mensagem. Por favor, tente novamente mais tarde.'); window.location.href = './';</script>";
            }
        }
    }
    exit;
}
?>
<!DOCTYPE html>
<!--

    Feito com carinho por uma equipe dedicada de desenvolvedores

    WhiteHats - https://whitehats.com.br
    Facebook - https://facebook.com/whitehatsbr
    Instagram - https://instagram.com/whitehatsbr

    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%&%%%&&&&&&&&&&&&&&&&&&&&&&&&&
    &%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%#%##(*,,,,,/(###%%%%%%%%%%%%%&&&&&&&&&&&&&&&&&&&&&
    &%%%%%%%%%%%%%%%%%( .                                           ....(%&&&&&&&&&&&&&&&
    &%%&%%%%%%%%,.                                             .    ..........*%&&&&&&&&&
    &%%%%%%%#...                                         .     .................,,%&&&&&&
    &&%%%%%/....                                       ........................,,,,#&&&&&
    &&&%%%%.....                                        .......             ....,,,*&&&&&
    &&%%%%*....    .......                             ...        .....,,,......,,,*%&&&&
    &%%%%%,.. .........,,,,,.....                            ..,,,,,.............,,,/&&&&
    &&%%%%...,&&&&%%%%%%&&&&%%,*,....                    .,,,*%#&&&&&&&&&&%%%%%%#,,,*&&&&
    &&&&%/.,&*,.......,*#&&&&&&&&&%&#/..         .    .,.(&&@@&&&&%&#*,,......,,,/#**&&&&
    &&&&&,,,....         ...,*(&%&&&&&&&%..  ....  ..(@&@@&&&&&/,,,.............,,,**%&&&
    &&&&%,,.....................,,,*&&&&&&&*..... *&&&#&&%***,,...............,,,,,**(&&&
    &&&&#,,.......................,,,,,,*(*........*#(*,*,,,,,.............,,,,,,,,***&&&
    &&&&/,,..............,,,......,,,,,,,..... ....,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,***&&&
    &&&&,.,,,.,,,,,,,,,,,,,,,,,,,,,,..,,,...    ..,,,,,,,,,,,,,,,,,*,,,,,,,,,,,,,,,*,*%&&
    &&&%,..,*,,,,,,*&&&&&&&&&&&&&&(,,,.....      ....,,,,,*#&&&&&&&&&&&&&%&*,,,,,,,,,*&@&
    &&&%,..........(&&&&&&&&&&&&&&&&%...          ......./%&&&&&&&&%%%%%&&(.,,,,,,,,,*&&&
    &&&%,.          .............                  ...... .......,,.,,,...   .......,*&&&
    &&&&,                                          ......                       .....*&&&
    &&&&.....                                      ......                   ....,,,,,*&@@
    &&&&/,,***,.                                    ......        .............,*///*(@@@
    &&&&&*,***,.............                        ..........................,,****/@@@@
    &&&&&%*,,,,....................                .......................,,,,,,,,*/@@@@@
    &&&&&&/,**,,,,,,......,...,,,.                 ..........,,,,,,,,,,,,,,,,,,****&@@@@@
    &&&&&&&/,,,*****,,,,,,,,..                     ...............,,,,,,,,,*******&@@@@@@
    &&&&&&&#/..,,,(/,,....        .........     ....,,,,,,,,,.........,,,,&&,**,*#@@@@@@@
    &&&&&&&&(/...,.%%  ..          .,//*,,,,,,..,,,*,,****,,,.........,..&&,,,,*(@@@@@@@@
    &&&&&&&&&/*....,(#(             ....,%&&&&&%&&&&&/,,,,,........... %&%,,,,*/&@@@@@@@@
    &&&&&&&&&&/*,...,,&#&#,      .....,&%%&#&%%*&&&&&@&#,........ .*&&&%**,,,*/%@@@@@@@@@
    &&&&&&&&&&&//,....,.#%%&&%&&&&%&&%&&%&@%%*,,**&&@@@@@&&&&&&&&&&&&(***,,,*/#@@@@@@@@@@
    &&&&&&&&&&&&/**,...,,...,*%&&%&&&%&&&&%*,,,,,,**@@@@@&&@&&(/**,,,**,,,*//&@@@@@@@@@@@
    &&&&&&&&&&&&&&/**,...,*,..  . ...,,******,*****,***,,,......,,****,,**/%@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@&/**,..,,,***,.....         ...........,,,***********/&@@@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@@@&/*,,..,,,,,,,,******************************,***/&@@@@@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@@@@@&**,,....,,,,,,,,,,*#&&@@@@@**,*,,*,********//@@@@@@@@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@@@@@@@&**,,..............%%&&@&/,,,,,,,,,,,****/@@@@@@@@@@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@@@@@@@@@@**,,,.......   .#%%%&&*,...,,,,,****/@@@@@@@@@@@@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@@@@@@@@@@@@*,,,.......  .(&%%&%,,.,,,,,****/@@@@@@@@@@@@@@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@@@@@@@@@@@@@&(,,........./&%&&&,,,,,,,***(@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@&*,,......,&&&&(*,,,***/#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@%**,,,,,%&@@/***//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@%#(&&#&@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@


    ------------------------------------------
    
    Co-fundador do projeto, backend e testes

    Flávio Pavim (kicko)
    Site: https://flaviopavim.com.br
    Facebook: https://facebook.com/rockandhack
    GitHub: https://github.com/flaviopavim
    LinkedIn: https://www.linkedin.com/in/kicko/

    ------------------------------------------

    Co-fundador, frontend e testes de segurança

    Leonardo Aguiar (Hasan)
    Site: https://leohasan.com
    Facebook: https://www.facebook.com/leonardo.silvaaguiar.7

    ------------------------------------------

    Conteúdo e testes e segurança

    Patrick Willen (Cego)
    Site: https://patrickwillen.com.br
    Facebook: https://www.facebook.com/patrickwillen.teixeiramagalhaes

    ------------------------------------------

    Testes e segurança

    Lenival Estevão (Leni)
    GitHub: https://github.com/lenivalestevao

    ------------------------------------------

    DDOS não é legal, não seja um script kiddie!
    Codar é arte, bug faz parte ;P

    ------------------------------------------
    ------------------------------------------

    Versão 1.0.algunsfixes

    ------------------------------------------
    ------------------------------------------

-->
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WhiteHats</title>
        <meta name="description" content="WhiteHats é uma empresa de desenvolvimento de sites e aplicativos. Oferecemos soluções personalizadas para o seu negócio.">
        <meta name="keywords" content="WhiteHats, desenvolvimento de sites, desenvolvimento de aplicativos, web design, aplicativos móveis, criação de Sites, marketing digital, desenvolvimento web, leads, vendas online">
        <meta name="author" content="Flávio Pavim">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />

        <meta property="og:locale" content="pt_BR" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="WhiteHats - Sites e aplicativos profissionais" />
        <meta property="og:description" content="Oferecemos soluções personalizadas para o seu negócio. Faça já seu orçamento!" />
        <meta property="og:url" content="https://whitehats.com.br/" />
        <meta property="og:site_name" content="WhiteHats" />

        <meta property="article:publisher" content="https://facebook.com/whitehatsbr" />
        <meta property="article:modified_time" content="<?php echo date('Y-m-d'); ?>T<?php echo date('H:i:s'); ?>+00:00" />

        <meta property="og:image" content="https://whitehats.com.br/img/wallpaper.png" />
        <meta property="og:image:width" content="769" />
        <meta property="og:image:height" content="471" />
        <meta property="og:image:type" content="image/jpeg" />

        <!--        <meta name="twitter:card" content="summary_large_image" />
                <meta name="twitter:site" content="#alexiasystem" />-->

        <link rel="icon" href="img/favicon.png" type="image/x-icon">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
            <img src="img/logo.png" alt=""/>
            <h2>Sua segurança é nossa prioridade!</h2>
        </header>

        <nav>
            <div class="container">
                <div class="row">
                    <ul>
                        <li>
                            <div class="col-md-3">
                                <a href="#sites">Construção de sites</a>
                            </div>
                        </li>
                        <li>
                            <div class="col-md-3">
                                <a href="#apps">Desenvolvimento de Aplicativos</a>
                            </div>
                        </li>
                        <!--                        <li>
                                                    <div class="col-md-3">
                                                        <a href="#desktop">Programas para Windows</a>
                                                    </div>
                                                </li>-->
                        <li>
                            <div class="col-md-3">
                                <a href="#nossos-trabalhos">Trabalhos</a>
                            </div>
                        </li>
                        <li>
                            <div class="col-md-3">
                                <a href="#contact">Entre em contato</a>
                            </div>
                        </li>
                        <!--                        <li>
                                                    <div class="col-md-2">
                                                        <a href="#automation">Automação</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-md-2">
                                                        <a href="#arduino">Arduino</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col-md-2">
                                                        <a href="#security">Segurança</a>
                                                    </div>
                                                </li>-->
                    </ul>
                </div>
            </div>
        </nav>

        <section id="sites">
            <div class="container">
                <center>
                    <h2>Construção de Sites</h2>
                    <p>Nossa equipe de designers e desenvolvedores cria sites atraentes e funcionais pra representar muito bem sua marca.</p>
                </center>
                <div style="clear: both; height: 30px;"></div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="img/sites.jpg" alt="" class="img-responsive"/>
                    </div>
                    <div class="col-md-6">

                        <p>
                            Um bom site vai muito além do que apenas códigos e imagens. 
                            É a materialização de uma visão, a manifestação da personalidade de um negócio e a porta de entrada para o sucesso online. 
                            Nossa missão é trazer essa visão à vida com maestria.
                        </p>
                        <div style="clear: both; height: 30px;"></div>
                        <h4>Design sob medida:</h4>
                        <p>
                            Entendemos que cada negócio é único, 
                            e é por isso que somos apaixonados por criar layouts modernos e personalizados para cada cliente. 
                            Cada site que desenvolvemos é uma obra de arte única, cuidadosamente elaborada para refletir a singularidade do seu empreendimento.
                        </p>
                        <div style="clear: both; height: 30px;"></div>
                        <h4>Responsividade e acessibilidade:</h4>
                        <p>
                            Em um mundo digital diversificado, 
                            é essencial que seu site seja totalmente responsivo. 
                            Nossos sites são projetados e testados para funcionar em diversos dispositivos, 
                            seja um smartphone, tablet ou desktop. 
                            A acessibilidade é uma prioridade, e garantimos que sua mensagem alcance todos os cantos da web.
                        </p>

                    </div>
                </div>
            </div>
        </section>

        <section id="apps">
            <div class="container">
                <center>
                    <h2>Desenvolvimento de Aplicativos</h2>
                    <p>Desenvolvemos aplicativos para iOS e Android que oferecem uma experiência de usuário excepcional.</p>
                </center>
                <div style="clear: both; height: 30px;"></div>
                <div class="row">
                    <div class="col-md-6">

                        <h4>Aplicativos personalizados:</h4>
                        <p>
                            Sempre surgem idéias incríveis para aplicativos. Faça sua idéia virar realidade!
                        </p>
                        <p>
                            Criamos os mais diversos tipos de aplicativos com confidencialidade e responsabilidade
                        </p>
                        <div style="clear: both; height: 30px;"></div>
                        <h4>Design criativo:</h4>
                        <p>
                            Escolhemos cuidadosamente cada cor, tamanho, fonte, alinhamento, para que seu aplicativo fique extremamente profissional
                        </p>
                        <div style="clear: both; height: 30px;"></div>
                        <h4>Funcionalidades diversas:</h4>
                        <p>
                            Os aplicativos tem a particularidade de usar os recursos do celular, como câmera, microfone, bluetooth, GPS, giroscópio, e os diversos ítens que vêm somando ao dispositivo.
                        </p>
                        <p>
                            Nossos aplicativos podem interagir com essas funcionalidades e proporcionar um produto único pro seu negócio!
                        </p>

                    </div>
                    <div class="col-md-6">
                        <img src="img/apps.png" alt="" class="img-responsive"/>
                    </div>
                </div>
            </div>
        </section>

        <section id="desktop">
            <div class="container">
                <center>
                    <h2>Programas Windows</h2>
                    <p>Criamos programas personalizados que atendem aos seus requisitos específicos para o ambiente desktop.</p>
                </center>
                <div style="clear: both; height: 30px;"></div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="img/desktop.jpg" alt="" class="img-responsive"/>
                    </div>
                    <div class="col-md-6">

                        <!--                        A tecnologia é uma aliada poderosa na otimização dos processos empresariais. Um bom programa pra gestão é essencial pra melhor eficiência do seu negócio.
                                                <div style="clear: both; height: 30px;"></div>-->

                        <h4>Personalizados para a gestão do seu negócio:</h4>
                        <p>
                            Um programa eficiente é uma ferramenta poderosa para a gestão de qualquer empresa. 
                            Criamos programas personalizados que atendam às necessidades do seu negócio, interligando e simplificando processos em toda a sua organização.
                        </p>
                        <div style="clear: both; height: 30px;"></div>
                        <h4>Programas de controle empresarial:</h4>
                        <p>
                            Desenvolvemos programas de controle que permitem que você gerencie sua empresa de maneira eficaz. Esses programas são projetados para operar em rede e pela internet. Controle de caixa, gestão de produtos, pedidos, estoque, emissão de notas fiscais, e soluções completas para cada empresa.
                        </p>
                    </div>
                </div>
            </div>
        </section>

<!--        <section id="automation">
    <div class="container">
        <center>
            <h2>Automação de Processos</h2>
            <p>Automatizamos tarefas repetitivas para aumentar a eficiência da sua operação.</p>
        </center>
        <div style="clear: both; height: 30px;"></div>
        <div class="row">
            <div class="col-md-4">
                <img src="img/sites.jpg" alt="" class="img-responsive"/>
            </div>
            <div class="col-md-4">
                <img src="img/sites.jpg" alt="" class="img-responsive"/>
            </div>
            <div class="col-md-4">
                <img src="img/sites.jpg" alt="" class="img-responsive"/>
            </div>
        </div>
    </div>
</section>

<section id="arduino">
    <div class="container">
        <center>
            <h2>Arduino</h2>
            <p>Realizamos testes abrangentes para garantir que seus dados e informações permaneçam seguros.</p>
        </center>
        <div style="clear: both; height: 30px;"></div>
        <div class="row">
            <div class="col-md-4">
                <img src="img/sites.jpg" alt="" class="img-responsive"/>
            </div>
            <div class="col-md-4">
                <img src="img/sites.jpg" alt="" class="img-responsive"/>
            </div>
            <div class="col-md-4">
                <img src="img/sites.jpg" alt="" class="img-responsive"/>
            </div>
        </div>
    </div>
</section>

<section id="security">
    <div class="container">
        <center>
            <h2>Testes de Segurança</h2>
            <p>Realizamos testes abrangentes para garantir que seus dados e informações permaneçam seguros.</p>
        </center>
        <div style="clear: both; height: 30px;"></div>
        <div class="row">
            <div class="col-md-4">
                <img src="img/sites.jpg" alt="" class="img-responsive"/>
            </div>
            <div class="col-md-4">
                <img src="img/sites.jpg" alt="" class="img-responsive"/>
            </div>
            <div class="col-md-4">
                <img src="img/sites.jpg" alt="" class="img-responsive"/>
            </div>
        </div>
    </div>
</section>-->



<!--        <section id="nossos-trabalhos">
            <div class="section-header">
                <center>
                    <h2>Nossos Trabalhos</h2>
                    <p>Confira alguns dos projetos incríveis que entregamos para nossos clientes.</p>
                </center>
            </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="img/sites.jpg" alt="" class="img-responsive"/>
                        </div>
                        <div class="col-md-4">
                            <img src="img/sites.jpg" alt="" class="img-responsive"/>
                        </div>
                        <div class="col-md-4">
                            <img src="img/sites.jpg" alt="" class="img-responsive"/>
                        </div>
                    </div>
                </div>
        </section>-->




        <section id="nossos-trabalhos">
            <div class="container">
                <center>
                    <h2>Trabalhos realizados</h2>
                </center>
                <div style="clear: both; height: 30px;"></div>
                <!--                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            Whitehats Security (em breve) são sistemas de segurança pra aplicativos Android e programas Windows
                                            <br>
                                            <br>
                                            Você pode capturar prints do seu computador com o aplicativo, bloquear computador, programar desligamento ou reinicialização, entre muitas outras novidades que estão por vir
                                            <br>
                                            <br>
                                            No aplicativo você poderá rastrear seu celular facilmente, e/ou obter todas as ferramentas de controle e segurança disponíveis
                                            <br>
                                            <br>
                                            Instale facilmente no Windows e tome controle de algumas funcionalidades do seu computador
                                            <br>
                                            <br>
                                            Estamos ampliando os sistemas à cada dia. Em breve teremos muitas novidades
                                            <br>
                                            <br>
                                            Site: <a href="https://whitehats.com.br/security" target="_blank">https://whitehats.com.br/security</a>
                
                                        </div>
                                        <div class="br-30"></div>
                                        <div class="col-md-2">
                                            <img class="img-responsive" src="img/work/whitehats-security-app-1.jpeg">
                                        </div>
                                        <div class="col-md-2">
                                            <img class="img-responsive" src="img/work/whitehats-security-app-2.jpeg">
                                        </div>
                                        <div class="col-md-2">
                                            <img class="img-responsive" src="img/work/whitehats-security-app-3.jpeg">
                                        </div>
                                        <div class="br-30"></div>
                                        <div class="col-md-2">
                                            <img class="img-responsive" src="img/work/whitehats-security-app-4.jpeg">
                                        </div>
                                        <div class="col-md-2">
                                            <img class="img-responsive" src="img/work/whitehats-security-app-5.jpeg">
                                        </div>
                                        <div class="col-md-2">
                                            <img class="img-responsive" src="img/work/whitehats-security-app-6.jpeg">
                                        </div>
                
                                    </div>-->
                
                <div class="row">
        <div class="col-md-5">
            <h2>Chat WhiteHats 1.0 - Beta</h2>
            
            <p>
                Um dos mais importantes trabalhos particulares no projeto WhiteHats.
            </p>
            <p>
                Nosso chat é criptografado ponta a ponta, os usuários combinam palavras chaves entre si, e conversam com segurança.
            </p>
            <p>
                O projeto está em versão Beta ainda não oficial. Em breve teremos o lançamento oficial.
            </p>
            
            
        </div>
        <div class="col-md-7">
            <img class="img-responsive" src="img/work/chat-site.png">
        </div>
        <div class="col-md-12">
            <p>
                O aplicativo está sendo finalizado pra lançar junto ou próximo ao site.
            </p>
            
            <p>
                Site: <a href="https://whitehats.com.br/chat" target="_blank">https://whitehats.com.br/chat</a>
            </p>
        </div>
    </div>
    <hr>
                
                <div class="row">
                    <div class="col-md-12">
                        WhiteHats Bluetooth control é um aplicativo pra controle de Arduinos e dispositivos compatíveis
                        <br>
                        <br>
                        Na PlayStore: <a href="https://play.google.com/store/apps/details?id=br.com.whitehats.bluetooth" target="_blank">https://play.google.com/store/apps/details?id=br.com.whitehats.bluetooth</a>
                        <br>
                        <br>
                        Código gratuito no GitHub: <a href="https://github.com/flaviopavim/bluetooth-control-arduino-pro-mini" target="_blank">https://github.com/flaviopavim/bluetooth-control-arduino-pro-mini</a>
                        <br>
                        <br>
                        Bônus:
                        <br>
                        Código do 'Sonar' (carrinho de controle feito no vídeo <a href="https://www.youtube.com/watch?v=BwsR14p9lc8" target="_blank">https://www.youtube.com/watch?v=BwsR14p9lc8</a>): <a href="https://github.com/flaviopavim/arduino-carrinho-radio-controle" target="_blank">https://github.com/flaviopavim/arduino-carrinho-radio-controle</a>
                        <br>
                        <br>

                    </div>
                    <div class="col-md-6">

                        <iframe class="video" src="https://www.youtube.com/embed/BwsR14p9lc8" frameborder="0" allowfullscreen></iframe>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-responsive" src="img/work/whitehats-bluetooth-control-1.webp">
                            </div>
                            <div class="col-md-4">
                                <img class="img-responsive" src="img/work/whitehats-bluetooth-control-2.webp">
                            </div>
                            <div class="col-md-4">
                                <img class="img-responsive" src="img/work/whitehats-bluetooth-control-3.webp">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-5">
                        <img class="img-responsive" src="img/work/alexiasystem.jfif">
                    </div>

                    <div class="col-md-7">
                        Alexia System foi um dos primeiros trabalhos feitos, com foco exclusivo em desenvolvimento de sites, aplicativos e prototipagem de máquinas.
                        <br>
                        <br>
                        Site: <a href="https://alexiasystem.com.br/" target="_blank">https://alexiasystem.com.br/</a>
                        <br>
                        <br>
                        De nome fictício, vindo do game Resident Evil Code Veronica (a vilã Alexia Ashford), é um site onde mantenho até hoje pra mostrar nossos trabalhos.
                        <br>
                        <br>
                        Desenvolvemos alguns aplicativos e sites com ajuda de designers e programadores
                        <!--https://www.youtube.com/shorts/Td9YQ7W8pRU-->

                        <div class="br-30"></div>
                        <iframe class="video" src="https://www.youtube.com/embed/Td9YQ7W8pRU" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        WhiteHats Crypt
                        <br>
                        <br>
                        Aplicativo para criptografar e descriptografar mensagens. Guarde com segurança o que é seu. Adicione uma palavra-chave de segurança e salve seus textos em locais seguros
                        <br>
                        <br>
                        Na PlayStore: <a href="https://play.google.com/store/apps/details?id=br.com.whitehats.bluetooth" target="_blank">https://play.google.com/store/apps/details?id=br.com.whitehats.bluetooth</a>
                        <br>
                        <br>
                        Em breve mais criptografias no aplicativos ;)
                        <br>
                        <br>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <img class="img-responsive" src="img/work/whitehats-crypt-1.webp">
                            </div>
                            <div class="col-md-6">
                                <img class="img-responsive" src="img/work/whitehats-crypt-2.webp">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TODO: VMG -->

                <hr>
                <div class="row">
                    <div class="col-md-8">
                        Naoradoclick
                        <br>
                        <br>
                        Site feito para o trabalho do fotógrafo Carlos Melo. O site traz àlbuns de diversos temas.
                        <br>
                        <br>
                        Site: <a href="https://naoradoclick.com.br/" target="_blank">https://naoradoclick.com.br/</a>
                        <br>
                        <br>
                        O site possui um design responsivo que se ajusta em diversos tipos de telas.
                        <br>
                        <br>
                        Painel administrativo protegido com login e senha para que o site seja alimentado com álbuns e fotos
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <img class="img-responsive" src="img/work/naoradoclick-adm-1.png">
                            </div>
                            <div class="col-md-6">
                                <img class="img-responsive" src="img/work/naoradoclick-adm-2.png">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <img class="img-responsive" src="img/work/naoradoclick.jfif">
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container">
                <h2>Entre em Contato</h2>
                <p>Estamos ansiosos para ajudá-lo a dar vida às suas ideias. Entre em contato conosco hoje mesmo!</p>
                <form action="./" method="POST">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] = md5(time() . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9)); ?>">
                    <input type="text" name="nome" placeholder="Seu Nome" required>
                    <input type="email" name="email" placeholder="Seu E-mail" required>
                    <textarea name="mensagem" placeholder="Sua Mensagem" required></textarea>
                    <button type="submit">Enviar Mensagem</button>
                </form>
            </div>
        </section>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Contato</h3>
        <!--                    <p>Endereço: Rua da Empresa, 12345</p>-->
                        <p>Telefone: (67) 9 9312-9223</p>
                        <p>Email: contato@whitehats.com.br</p>

                        <!--<div style="clear: both; height: 30px;"></div>-->
                        <div class="social-icons">
                            <a href="https://wa.me/5518996626124" target="_blank">
                                <img style="margin: 0 0 5px 0;" width="20" src="img/social/whatsapp.png"> &nbsp;+55 (18) 99662-6124
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h3>Links</h3>
                        <ul>
                            <li><a href="#">Início</a></li>
                            <li><a href="#sites">Construção de sites</a></li>
                            <li><a href="#apps">Desenvolvimento de aplicativos</a></li>
                            <li><a href="#desktop">Programas para Windows</a></li>
                            <li><a href="#nossos-trabalhos">Trabalhos</a></li>
                            <li><a href="#contact">Contato</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Redes Sociais</h3>
                        Siga nossas redes sociais e fique por dentro de novidades ;)
                        <br>
                        <br>
                        <div class="social-icons">
                            <a target="_blank" href="https://www.facebook.com/whitehatsbr" class="icon-facebook">
                                <img src="img/social/facebook.png"> Facebook
                            </a>
                            <a target="_blank" href="https://www.linkedin.com/company/whitehats-br" class="icon-linkedin">
                                <img src="img/social/linkedin.png"> Linkedin
                            </a>
                            <a target="_blank" href="https://www.instagram.com/whitehatsbr" class="icon-instagram">
                                <img src="img/social/instagram.png"> Instagram
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear: both; height: 15px"></div>
            <div class="container">
                <div class="col-md-12">
                    <hr style="border-top: 1px #555 solid;">
                </div>
            </div>
            <div style="clear: both; height: 10px"></div>
            <p class="footer-copyright">&copy; <?php echo date('Y'); ?> WhiteHats</p>
        </footer>

        <div id="right">

            <a href="https://linkedin.com/company/whitehats-br" alt="https://linkedin.com/company/whitehats-br" title="https://linkedin.com/company/whitehats-br" target="_blank">
                <img src="img/social/linkedin.png">    
            </a>
            <div style="clear: both; height: 5px"></div>
            <a href="https://facebook.com/whitehatsbr" alt="https://facebook.com/whitehatsbr" title="https://facebook.com/whitehatsbr" target="_blank">
                <img src="img/social/facebook.png">    
            </a>
            <div style="clear: both; height: 5px"></div>
            <a href="https://instagram.com/whitehatsbr" alt="https://instagram.com/whitehatsbr" title="https://instagram.com/whitehatsbr" target="_blank">
                <img src="img/social/instagram.png">    
            </a>
            <div style="clear: both; height: 5px"></div>
            <a href="https://youtube.com/@whitehatsbr" alt="https://youtube.com/@whitehatsbr" title="https://youtube.com/@whitehatsbr" target="_blank">
                <img src="img/social/youtube.png">    
            </a>
            <!--            <div style="clear: both; height: 5px"></div>
                        <a href="@algumapagina" alt="@algumapagina" title="@algumapagina" target="_blank">
                            <img src="http://localhost/katiacabeleireira.com.br/adm/img/social/twitter.png">    
                        </a>
                        <div style="clear: both; height: 5px"></div>
                        <a href="#" alt="@algumapagina" title="@algumapagina">
                            <img src="http://localhost/katiacabeleireira.com.br/adm/img/social/kwai.png">    
                        </a>
                        <div style="clear: both; height: 5px"></div>
                        <a href="#" alt="@algumapagina" title="@algumapagina">
                            <img src="http://localhost/katiacabeleireira.com.br/adm/img/social/tiktok.png">    
                        </a>-->


            <div style="clear: both; height: 5px"></div>
            <a href="https://wa.me/5518996626124" target="_blank">
                <img src="img/social/whatsapp.png">    
            </a>
            <div style="clear: both; height: 5px"></div>
            <div class="br"></div>
        </div>

    </body>
</html>