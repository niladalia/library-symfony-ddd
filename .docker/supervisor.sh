
 supervisorctl -c /etc/supervisor/supervisord.conf stop messenger-consume-create:*
 supervisorctl -c /etc/supervisor/supervisord.conf stop messenger-consume-update:*
 supervisorctl -c /etc/supervisor/supervisord.conf stop messenger-consume-delete:*
 supervisord -c /etc/supervisor/supervisord.conf
 supervisorctl -c /etc/supervisor/supervisord.conf reread
 supervisorctl -c /etc/supervisor/supervisord.conf update
 supervisorctl -c /etc/supervisor/supervisord.conf start messenger-consume-create:*
 supervisorctl -c /etc/supervisor/supervisord.conf start messenger-consume-update:*
 supervisorctl -c /etc/supervisor/supervisord.conf start messenger-consume-delete:*
