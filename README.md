# effect-media-protector

Required ACF to be installed. Adds a checkbox to attachments to mark them as protected. If marked then a user must be logged in to access them.

Following must be added to .htaccess to route attachments through the plugin
```
RewriteEngine On  
RewriteRule ^wp-content\/uploads\/(.+)\.pdf$ /?action=load_attachment&file=$1 [L,NC,QSA]
```
