uCoz permalink migration
===
Плагин для Wordpress, который помогает переехать с uCoz.

Умеет редиректить урлы следующих видов:

```%SITE_URL%/index/86-231-5-1``` — такие урлы получаются при включении, а затем выключении ЧПУ.  
```%SITE_URL%/index/0-5``` — это обычно страницы, сделает редирект на страницу с id, который будет соответствовать последней цифре.  
```%SITE_URL%/blog/2010-03-20-209-0-2``` — это страницы с записями, где много комментов. Редирект будет на страницу поста.  
```%SITE_URL%/blog/2``` — Возможно это страницы пагинатора, перенаправляет в ```/page/%PAGE_NUM%```.   
```%SITE_URL%/blog/1-0-2``` — это категории блога. У самих категорий slug(ярлык) должен совпадать с цифрами в запросе.    
```%SITE_URL%/go?http://dimapolyakov.ru``` — Редиректы на внешние сайты. Отдает 302 редирект для браузера.  
