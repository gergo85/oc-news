<?php

return [
    'plugin' => [
        'name' => 'Notícias e Newsletter',
        'description' => 'Plugin simples para notícias e newsletter.',
        'author' => 'Gergő Szabó'
    ],
    'menu' => [
        'news' => 'Notícias',
        'posts' => 'Postagens',
        'categories' => 'Categorias',
        'subscribers' => 'Inscritos',
        'statistics' => 'Estatísticas',
        'import' => 'Importar',
        'export' => 'Exportar',
        'logs' => 'Logs',
        'settings' => 'Configurações'
    ],
    'title' => [
        'posts' => 'postagem',
        'categories' => 'categoria',
        'subscribers' => 'inscrito'
    ],
    'new' => [
        'posts' => 'Nova postagem',
        'categories' => 'Nova categoria',
        'subscribers' => 'Novo inscrito'
    ],
    'stat' => [
        'posts' => 'Postagem|Postagens',
        'view' => 'Visualizações',
        'mail' => 'Enviados',
        'loss' => 'Perdidos',
        'top' => 'TOP',
        'longest' => 'Maiores',
        'shortest' => 'Menores',
        'queued' => 'Na fila',
        'send' => 'Enviar',
        'sent' => 'Enviado',
        'viewed' => 'Visto',
        'click' => 'Cliques',
        'clicked' => 'Clicados',
        'failed' => 'Fallhas',
        'log' => [
            'events' => 'Eventos',
            'summary' => 'Resumo'
        ]
    ],
    'form' => [
        // General
        'id' => 'ID',
        'created_at' => 'Criado em',
        'updated_at' => 'Atualizado em',
        // Posts
        'title' => 'Titulo',
        'slug' => 'Slug',
        'introductory' => 'Introdução',
        'content' => 'Conteúdo',
        'image' => 'Imagem',
        'category' => 'Categoria',
        'author' => 'Autor',
        'status' => 'Status',
        'status_published' => 'Publicado',
        'status_hide' => 'Oculto',
        'status_draft' => 'Rascunho',
        'status_active' => 'Ativo',
        'status_inactive' => 'Inativo',
        'status_unsubscribed' => 'Descadastrado',
        'featured' => 'Destaque',
        'hidden' => 'Está oculto?',
        'yes' => 'Sim',
        'no' => 'Não',
        'view' => 'ver',
        'published_at' => 'Publicado em',
        'last_send_at' => 'Enviado por último em',
        'last_send' => 'Enviado por último ',
        'length' => 'Tamanho',
        'seo_tab' => 'SEO definições',
        'seo_title' => 'Título',
        'seo_keywords' => 'Palavras-chave',
        'seo_desc' => 'Descrição',
        'seo_image' => 'OG imagem',
        // Subscribers
        'name' => 'Nome',
        'email' => 'E-mail',
        'comment' => 'Comentário',
        'locale' => 'Local',
        'lang' => 'pt',
        'mail' => 'email',
        // Logs
        'news' => 'Postagens',
        'subscriber_name' => 'Nome do inscrito',
        'subscriber_email' => 'E-mail do inscrito',
        'queued_at' => 'Em fila',
        'send_at' => 'Enviado',
        'viewed_at' => 'Visto',
        'clicked_at' => 'Clicado',
        'logs_count' => 'Registros de Logs'
    ],
    'button' => [
        'activate' => 'Ativar',
        'deactivate' => 'Ocultar',
        'active' => 'Ativo',
        'inactive' => 'Inativo',
        'reorder' => 'Reordenar',
        'import' => 'Importar',
        'export' => 'Exportar',
        'unsubscribe' => 'Cancelar inscrição',
        'subscribe' => 'Inscrição',
        'test' => 'Enviar e-mail de teste',
        'send' => 'Enviar newsletter',
        'send_confirmation' => 'Você deseja enviar a newsletter?',
        'resend' => 'Reenviar newsletter',
        'resend_confirmation' => 'Você deseja reenviar a newsletter?',
        'return' => 'Voltar'
    ],
    'flash' => [
        'activate' => 'Postagens ativadas com sucesso.',
        'deactivate' => 'Postagens desativadas com sucesso.',
        'subscribe' => 'Inscrições efetuadas com sucesso.',
        'unsubscribe' => 'Inscrições canceladas com sucesso.',
        'delete' => 'Você deseja deletar estes itens?',
        'remove' => 'Itens removidos com sucesso.',
        'newsletter_test_error' => 'Um erro ocorreu ao enviar a newsletter de teste.',
        'newsletter_send_success' => 'Newsletter enviada com sucesso.',
        'newsletter_send_error' => 'Um erro ocorreu ao enviar newsletter. Antes de reenviar verifique o log para obter o status atualizado!',
        'newsletter_resend_success' => 'Newsletter reenviada com sucesso.',
        'newsletter_resend_error' => 'Um erro ocorreu ao reenviar newsletter. Antes de reenviar verifique o log para obter o status atualizado.'
    ],
    'backend_settings' => [
        'description' => 'Configurações de envio de newsletters e estatísticas de visualizações.',
        'main_section' => 'Configurações de envio e tratamento de newsletters',
        'click_tracking' => 'Rastrear clicks',
        'click_tracking_comment' => 'Rastrear quando a pessoa clica em um link da newsletter.',
        'email_view_tracking' => 'Rastrear visualizações da newsletter ',
        'email_view_tracking_comment' => 'Rastrear quando a pessoa visualiza a newsletter.',
        'email_view_tracking_warning' => [
            'heading' => 'Cuidado ao usar esta funcionalidade',
            'subheading' => 'Isto é ilegal em alguns países!',
            'text' => 'Quando você usa esta funcionalidade você precisa se certificar que isto é permitido em seu país! Tenha certeza que você não está infringindo nenhuma lei.'
        ],
        'statistic_show_posts' => 'Exibir postagens',
        'statistic_show_mails' => 'Exibir logs de emails',
        'statistic_show_longest_posts' => 'Exibir postagens por tamanho (maiores)',
        'statistic_show_shortest_posts' => 'Exibir postagens por tamanho (menores)'
    ],
    'widget' => [
        'posts' => 'Notícias - Postagens',
        'newposts' => 'Notícias - Novas postagens',
        'topposts' => 'Notícias - Top postagens',
        'subscribers' => 'Notícias - inscritos',
        'show_total' => 'Exibir total',
        'show_active' => 'Exibir ativos',
        'show_inactive' => 'Exibir inativos',
        'show_draft' => 'Exibir rascunhos',
        'show_piece' => 'Número de postagens',
        'show_date' => 'Exibir data',
        'show_unsub' => 'Exibir descadastrados',
        'total' => 'Total'
    ],
    'component' => [
        'posts' => 'Mostrar postagens',
        'post' => 'Conteúdo da postagem',
        'categories' => 'Categorias',
        'subscribe' => 'Formulário de inscrição',
        'unsubscribe' => 'Formulário de descadastro'
    ],
    'permission' => [
        'posts' => 'Gerenciar postagens',
        'categories' => 'Gerenciar categorias',
        'subscribers' => 'Gerenciar inscritos',
        'statistics' => 'Ver estatísticas',
        'import_export' => 'Importar e Exportar',
        'settings' => 'Alterar configurações',
        'logs' => 'Visualizações detalhadas para logs'
    ],
    'settings' => [
        'slug_title' => 'Slug da postagem',
        'slug_description' => 'Buscar postagem a partir de uma slug.',
        'pagination_title' => 'Número de página',
        'pagination_description' => 'Este valor é usado para determinar em qual página o usuário está.',
        'per_page_title' => 'Postagens por página',
        'per_page_validation' => 'Formato inválido de valor para o campo postagens por página',
        'no_posts_title' => 'Nenhuma mensagem',
        'no_posts_description' => 'Mensagem a ser exibida na listagem de postagens caso não haja resultados. Esta propriedade é usada pelo componente padrão: partial.',
        'no_posts_found' => 'Nenhuma postagem encontrada',
        'posts_order_title' => 'Ordenação de postagens',
        'posts_order_description' => 'Atributo pelo qual as postagens devem ser ordenados',
        'post_title' => 'Página',
        'post_description' => 'Nome da página para os links de "Leia mais". Esta propriedade é usada pelo componente padrão: partial.',
        'featured_title' => 'Listagem de destaques',
        'featured_description' => 'Escolha quais postagens exibir',
        'list_all' => 'Todos',
        'list_featured' => 'Apenas destaques',
        'list_notfeatured' => 'Sem destaque',
        'translated_title' => 'Exibir apenas postagens traduzidos',
        'translated_description' => 'Ocultar a postagem se não estiver no mesmo idioma do site.',
        'category_page_title' => 'Página de categoria',
        'category_page_description' => 'Nome da página de categoria para os links de categoria. Esta propriedade é usada pelo componente padrão: partial.',
        'category_filter_title' => 'Filtro de categoria',
        'category_filter_description' => 'Insira o slug da categoria ou uma URL como parametro para filtrar as postagens. Deixar em branco vai exibir todas as postagens.',
        'links' => 'Links'
    ],
    'sorting' => [
        'title_asc' => 'Título (crescente)',
        'title_desc' => 'Título (decrescente)',
        'created_at_asc' => 'Criado em (crescente)',
        'created_at_desc' => 'Criado em (decrescente)',
        'updated_at_asc' => 'Atualizado em (crescente)',
        'updated_at_desc' => 'Atualizado em (decrescente)',
        'published_at_asc' => 'Publicado em (crescente)',
        'published_at_desc' => 'Publicado em (decrescente)'
    ],
    'sitemap' => [
        'post_list' => 'Lista de postagens',
        'post_page' => 'Página de postagem'
    ],
    'messages' => [
        'unsubscribed' => 'Você foi descadastrado com sucesso da nossa newsletter.',
        'not_subscribed' => 'Você já está inscrito na nossa newsletter.',
        'subscribed' => 'Obrigado pela sua inscrição na nossa newsletter!'
    ]
];
