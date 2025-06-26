<?php namespace ProcessWire;

if (page()->editable()): ?>
	<span class="editorbuttons">
		<a style='margin-bottom:1px;display:block; padding:5px 8px; color:#fff; background:green;' href='<?= $config->urls->admin ?>page/edit/?id=<?= $page->id ?>'>Изменить</a>
		<a style='margin-bottom:1px;display:block; padding:5px 8px; color:#fff; background:#000;' href='<?= $config->urls->admin ?>'>Структура сайта</a>
		<a style='margin-bottom:1px;display:block; padding:5px 8px; color:#fff; background:#000;' href='<?= $config->urls->admin ?>page/edit/?id=2539'>Настройки</a>
		<a style='margin-bottom:1px;display:block; padding:5px 8px; color:#fff; background:#000;' href='<?= $config->urls->admin ?>setup/clear-cache-admin/clearpagecache'>Очистить кэш</a>
		<a style='margin-bottom:1px;display:block; padding:5px 8px; color:#fff; background:red;' href='<?= $config->urls->root ?>megaeditor/login/logout/'>Выход</a>
	</span>
	<style>
		.editorbuttons {
			text-align: center;
			position: fixed;
			max-width: 180px;
			z-index: 2000;
			bottom: 70px;
			left: 0;
			font-size: 12px;
			font-weight: bold;
		}

		.editorbuttons a {
			transition: .5s;
			transform: translate(-70px, 0);
		}

		.editorbuttons:hover a {
			transform: translate(0, 0);
		}

		.editorbuttons a:hover {
			text-decoration: underline;
		}
	</style>
<?php endif ?>