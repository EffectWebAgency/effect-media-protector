# effect-media-protector

RewriteEngine On
RewriteRule ^wp-content\/uploads\/(.+)\.pdf$ /?action=load_attachment&file=$1 [L,NC,QSA]