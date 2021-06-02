# Luiza Labs - Prova Backend
Esta é a submissão da avaliação da Luiza Labs para a função de desenvolvedor fullstack. O desafio consiste em implementar uma API que proverá o serviço de backend básico para um sistema de pedidos em um e-commerce.
Dentre os requisitos exigidos, no que se trata ao envio do email, usei uma conta no SendGrid e o mesmo exige uma API Key. Fazendo uso de boas praticas de segurança, a API Key foi enviada via mensagem para o LinkedIn da recrutadora Lorena Cunha. Logo, basta selecionar a Key e colocá-la no lugar da string `SENDGRID_KEY`, que se encontra no arquivo `.env.example`.

Outro requisitos da prova era a exportação do pdf ser via POST. Nesse aspecto, tomei a liberdade de transformar em GET, pois faz mais sentido semântico e facilita o teste.

## Requisitos para rodar a aplicação:
**Instalar o Docker.** 
Para instalá-lo é só seguir as instruções contidas em:[https://docs.docker.com/get-docker/](https://docs.docker.com/get-docker/)

**Clonar o repositório**

    git clone https://github.com/felipe2rod/prova-LuizaLabs.git

**Rodar API**
Para rodar a API execute os comandos abaixo:

    cd prova-LuizaLabs
	docker-compose build
    docker-compose up -d

E pronto! Os comandos farão rodar todas as operações necessárias para rodar a aplicação. Uma vez que as migrations e seeds dependem do container do banco estar disponível, o mesmo levará alguns segundos - após o terminal informar que os containers estão online - para iniciar plenamente.

A API estará disponível em  [http://localhost:8090](http://localhost:8090/).

## Padrão de commits:
O padrão adotado para os commits deste projeto foi de acordo com o  [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/)

## Conceitos abordados neste projeto:

 - SOLID principles
 - [Boas praticas do laravel](https://github.com/jonaselan/laravel-best-practices). 
 - Docker
 - Tratamento de erros
 - TDD
