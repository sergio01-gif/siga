<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>IMPOM</title>
  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Nunito', sans-serif; }
    .fade {
      transition: opacity 1s ease-in-out;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800 pt-28">
  <!-- Cabeçalho fixo -->
  <header class="bg-white shadow-md py-6 px-4 text-center fixed top-0 w-full z-50">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between">
      <div class="flex items-center space-x-4">
        <img src="{{asset('images/logo.png')}}" class="w-12 h-12" alt="Logo">
        <h1 class="text-3xl font-bold text-[#0072CE]">IMPOM</h1>
      </div>
      <nav class="mt-4 md:mt-0 space-x-4">
      <a href="#sobre" class="text-[#0072CE] hover:text-[#F9B000]">Sobre Nós</a>
        <a href="#cursos" class="text-[#0072CE] hover:text-[#F9B000]">Cursos</a>
        <a href="#noticias" class="text-[#0072CE] hover:text-[#F9B000]">Notícias</a>
        <a href="#galeria" class="text-[#0072CE] hover:text-[#F9B000]">Galeria</a>
        @auth
          <a href="{{ url('/home') }}" class="text-[#F9B000] font-semibold">Home</a>
        @else
          <a href="{{ route('login') }}" class="bg-[#0072CE] text-white px-4 py-1 rounded hover:bg-[#005a9c]">Login</a>
        @endauth
      </nav>
    </div>
  </header>

  

  <!-- Slideshow Melhorado -->
  <section class="relative max-w-7xl mx-auto mt-10 h-[400px] rounded-lg overflow-hidden shadow-lg">
    <div class="relative w-full h-full">
      <div class="absolute inset-0">
        <div class="carousel-slide fade w-full h-full absolute inset-0 opacity-100">
          <img src="images/background.jpg" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <h2 class="text-white text-3xl md:text-5xl font-bold text-center px-4">Bem-vindo ao Instituto IMPOM</h2>
          </div>
        </div>
        <div class="carousel-slide fade w-full h-full absolute inset-0 opacity-0">
          <img src="images/electricidade.jpg" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <h2 class="text-white text-3xl md:text-5xl font-bold text-center px-4">Formação técnica de qualidade</h2>
          </div>
        </div>
        <div class="carousel-slide fade w-full h-full absolute inset-0 opacity-0">
          <img src="images/bravia.jpg" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <h2 class="text-white text-3xl md:text-5xl font-bold text-center px-4">Excelência e inovação no ensino</h2>
          </div>
        </div>
      </div>
    </div>
  </section>

  

  <!-- Sobre o Instituto -->
  <section id="sobre" class="mt-16 max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-10 items-center">
    <img src="images/background.jpg" alt="Instituto" class="rounded shadow">
    <div>
      <h2 class="text-2xl font-bold text-[#0072CE] mb-4">Sobre o IMPOM</h2>
      <p>O Instituto Médio Politécnico Macequece (IMPOM) é uma instituição de ensino técnico profissional ao serviço da sociedade, destinada a produzir e disseminar a ciência, a tecnologia, a investigação e a extensão focalizando as áreas agrárias e industriais, educando as gerações com valores humanísticos de modo a enfrentarem os desafios contemporâneos em prol do desenvolvimento da sociedade.</p>
    </div>
  </section>

  <!-- Missão, Visão e Valores -->
  <section class="mt-16 bg-white py-12">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-3 gap-6 text-center">
      <div>
        <h3 class="text-xl font-semibold text-[#0072CE]">Missão</h3>
        <p class="mt-2">Produzir e disseminar a ciência e promover a inovação através da investigação como fundamento dos processos de ensino-aprendizagem e extensão, valorizando o saber humano para enfrentar os desafios socioeconómicos e ambientais do país.</p>
      </div>
      <div>
        <h3 class="text-xl font-semibold text-[#0072CE]">Visão</h3>
        <p class="mt-2">Tornar-se numa instituição de Educação Técnico-profissional de classe regional dedicada à busca e promoção da excelência em ciência, tecnologia e inovação e suas aplicações para o crescimento económico e desenvolvimento sustentável da região.</p>
      </div>
      <div>
        <h3 class="text-xl font-semibold text-[#0072CE]">Valores</h3>
        <p class="mt-2">Integridade, Responsabilidade, Inovação, Criatividade, Colaboração, Inclusão, Racionalidade, Autenticidade, Honestidade intelectual e Excelência em Desempenho
        </p>
      </div>
    </div>
  </section>

<!-- Cursos -->
<section id="cursos" class="mt-16 py-12 bg-gray-100">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-2xl font-bold text-center text-[#0072CE] mb-10">Nossos Cursos</h2>
    <div class="grid md:grid-cols-3 gap-8">
      
      <!-- Curso 1 -->
      <div class="relative bg-white rounded shadow hover:shadow-lg transition overflow-hidden" style="background-image: url('images/mineracao1.jpg'); background-size: cover; background-position: center;">
        <div class="bg-black bg-opacity-60 p-6 h-full text-white">
          <h4 class="text-lg font-semibold">Indústrial Extrativa - Mineração</h4>
          <p class="mt-2 text-sm">Profissionais para atuar na extração e no processamento de minérios com foco em segurança e sustentabilidade.</p>
          <a href="https://wa.me/+258864904273?text=Quero%20saber%20mais%20sobre%20o%20curso%20de%20Mineração" target="_blank" class="inline-block mt-4 bg-[#25D366] text-white px-4 py-2 rounded hover:bg-[#1ebd5a] transition">Quero me Inscrever</a>
        </div>
      </div>

      <!-- Curso 2 -->
      <div class="relative bg-white rounded shadow hover:shadow-lg transition overflow-hidden" style="background-image: url('images/florestal.jpg'); background-size: cover; background-position: center;">
        <div class="bg-black bg-opacity-60 p-6 h-full text-white">
          <h4 class="text-lg font-semibold">Florestas e Fauna Bravia</h4>
          <p class="mt-2 text-sm">Capacita profissionais para o manejo sustentável de florestas e conservação da biodiversidade.</p>
          <a href="https://wa.me/+258864904273?text=Quero%20saber%20mais%20sobre%20o%20curso%20de%20Florestas%20e%20Fauna%20Bravia" target="_blank" class="inline-block mt-4 bg-[#25D366] text-white px-4 py-2 rounded hover:bg-[#1ebd5a] transition">Quero me Inscrever</a>
        </div>
      </div>

      <!-- Curso 3 -->
      <div class="relative bg-white rounded shadow hover:shadow-lg transition overflow-hidden" style="background-image: url('images/electricidade.jpg'); background-size: cover; background-position: center;">
        <div class="bg-black bg-opacity-60 p-6 h-full text-white">
          <h4 class="text-lg font-semibold">Electricidade Industrial</h4>
          <p class="mt-2 text-sm">Instalação e manutenção de sistemas elétricos industriais com foco em segurança e automação.</p>
          <a href="https://wa.me/+258864904273?text=Quero%20saber%20mais%20sobre%20o%20curso%20de%20Electricidade%20Industrial" target="_blank" class="inline-block mt-4 bg-[#25D366] text-white px-4 py-2 rounded hover:bg-[#1ebd5a] transition">Quero me Inscrever</a>
        </div>
      </div>

      <!-- Curso 4 -->
      <div class="relative bg-white rounded shadow hover:shadow-lg transition overflow-hidden" style="background-image: url('images/agropecuaria.jpg'); background-size: cover; background-position: center;">
        <div class="bg-black bg-opacity-60 p-6 h-full text-white">
          <h4 class="text-lg font-semibold">Agro-Pecuária</h4>
          <p class="mt-2 text-sm">Produção agrícola e pecuária com foco em manejo sustentável, produtividade e gestão rural.</p>
          <a href="https://wa.me/+258864904273?text=Quero%20saber%20mais%20sobre%20o%20curso%20de%20Agro-pecuária" target="_blank" class="inline-block mt-4 bg-[#25D366] text-white px-4 py-2 rounded hover:bg-[#1ebd5a] transition">Quero me Inscrever</a>
        </div>
      </div>

      <!-- Curso 5 -->
      <div class="relative bg-white rounded shadow hover:shadow-lg transition overflow-hidden" style="background-image: url('images/mecanica.jpg'); background-size: cover; background-position: center;">
        <div class="bg-black bg-opacity-60 p-6 h-full text-white">
          <h4 class="text-lg font-semibold">Mecânica-Auto</h4>
          <p class="mt-2 text-sm">Manutenção e reparação de veículos automotores, com foco em sistemas mecânicos e eletrônicos.</p>
          <a href="https://wa.me/+258864904273?text=Quero%20saber%20mais%20sobre%20o%20curso%20de%20Mecânica-Auto" target="_blank" class="inline-block mt-4 bg-[#25D366] text-white px-4 py-2 rounded hover:bg-[#1ebd5a] transition">Quero me Inscrever</a>
        </div>
      </div>

      <!-- Curso 6 -->
      <div class="relative bg-white rounded shadow hover:shadow-lg transition overflow-hidden" style="background-image: url('images/mineracaoboa.jpg'); background-size: cover; background-position: center;">
        <div class="bg-black bg-opacity-60 p-6 h-full text-white">
          <h4 class="text-lg font-semibold">Construção Civil</h4>
          <p class="mt-2 text-sm">Planejamento e execução de obras, com técnicas modernas e foco em segurança e sustentabilidade.</p>
          <a href="https://wa.me/+258864904273?text=Quero%20saber%20mais%20sobre%20o%20curso%20de%20Construção%20Civil" target="_blank" class="inline-block mt-4 bg-[#25D366] text-white px-4 py-2 rounded hover:bg-[#1ebd5a] transition">Quero me Inscrever</a>
        </div>
      </div>

    </div>
  </div>
</section>


 <!-- Notícias -->
<section id="noticias" class="mt-16 py-12 bg-white">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-2xl font-bold text-center text-[#0072CE] mb-10">Notícias Recentes</h2>
    <div class="grid md:grid-cols-3 gap-6">
      
      <!-- Notícia 1 -->
      <div class="bg-gray-100 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <img src="images/visitamineracao.jpg" alt="Visita do Ministro" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-[#0072CE] text-lg">Visita as mineradoras</h3>
          <p class="mt-2 text-sm text-gray-700">O Instituto realizou visitas nas mineradoras no distrito de Manica, onde os alunos do curso de Mineração tiveram a oportunidade de conhecer o conceito real do seu curso.</p>
          <a href="#" class="inline-block mt-3 text-sm text-[#0072CE] hover:underline">Ler mais</a>
        </div>
      </div>

      <!-- Notícia 2 -->
      <div class="bg-gray-100 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <img src="images/visitauem.jpg" alt="Laboratórios Inaugurados" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-[#0072CE] text-lg">Visita a UEM</h3>
          <p class="mt-2 text-sm text-gray-700">Os estudantes do curso de Florestas e Fauna Bravia tiveram a oportunidade de realizar visita de experiência as instalações da UEM Faculdade de Agronomia e Engenharia Florestal.</p>
          <a href="#" class="inline-block mt-3 text-sm text-[#0072CE] hover:underline">Ler mais</a>
        </div>
      </div>

      <!-- Notícia 3 -->
      <div class="bg-gray-100 rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <img src="images/inscricoesimpom.jpg" alt="Inscrições Abertas" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-[#0072CE] text-lg">Inscrições Abertas para 2025</h3>
          <p class="mt-2 text-sm text-gray-700">As inscrições para o ano letivo de 2025 já começaram. Garanta sua vaga e estude num dos melhores institutos técnicos da região.</p>
          <a href="#" class="inline-block mt-3 text-sm text-[#0072CE] hover:underline">Ler mais</a>
        </div>
      </div>

    </div>
  </div>
</section>



   <!-- Galeria -->
  <section id="galeria" class="mt-16 py-12 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-2xl font-bold text-center text-[#0072CE] mb-10">Galeria</h2>
      <div class="grid md:grid-cols-4 gap-4">
        <img src="images/background.jpg" class="rounded shadow">
        <img src="images/background.jpg" class="rounded shadow">
        <img src="images/background.jpg" class="rounded shadow">
        <img src="images/background.jpg" class="rounded shadow">
      </div>
    </div>
  </section>


  <!-- Rodapé -->
  <footer class="bg-[#0072CE] text-white mt-16 py-6 text-center text-sm">
    <div class="mb-4">
      <p>Email: info@impom.co.mz</p>
      <p>Telefone: +258 83 368 8477; 864904273</p>
      <p>Localização: Bairro Central, Macequece, Moçambique</p>
    </div>
    <p>© {{ date('Y') }} IMPOM - Instituto Médio Politécnico Macequece. Todos os direitos reservados.</p>
  </footer>

 <!-- JS para slideshow com fade -->
 <script>
    const slides = document.querySelectorAll(".carousel-slide");
    let index = 0;

    setInterval(() => {
      slides[index].style.opacity = 0;
      index = (index + 1) % slides.length;
      slides[index].style.opacity = 1;
    }, 5000);
  </script>

</body>
</html>

