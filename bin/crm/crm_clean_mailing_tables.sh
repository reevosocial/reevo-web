#!/bin/bash

# ----
# Copyright (C) 2013-2015 - Reevo Project (http://reevo.org)
# License: Affero GPL version 3 - http://www.gnu.org/licenses/agpl.html 
# ES: Este archivos es parte de: reevo-web (http://git.reevo.org/reevo/reevo-web)
# EN: This file is part of: reevo-web (http://git.reevo.org/reevo/reevo-web)
# ----
cd /srv/reevo-web/bin/crm
source ../database_auth.sh

echo "use reevo_crm;
set @fecha = (now()- INTERVAL 30 DAY);

select 'Limpiando tablas' AS ' ';

create temporary table temp_mail_job_ids 
select id as job_id, mailing_id
from civicrm_mailing_job
where start_date < @fecha ;

create index temp_job_id     on temp_mail_job_ids ( job_id     ) ;
create index temp_mailing_id on temp_mail_job_ids ( mailing_id ) ;

delete from civicrm_mailing_trackable_url 
where mailing_id in ( select mailing_id from temp_mail_job_ids ) ;

delete from civicrm_mailing_group 
where mailing_id in ( select mailing_id from temp_mail_job_ids ) ;

delete from civicrm_mailing_event_unsubscribe
where time_stamp < @fecha ;

delete from civicrm_mailing_event_trackable_url_open
where time_stamp < @fecha ;

delete from civicrm_mailing_event_reply
where time_stamp < @fecha ;

delete from civicrm_mailing_event_queue
where job_id in ( select job_id from temp_mail_job_ids ) ;

delete from civicrm_mailing_event_opened
where time_stamp < @fecha ;

delete from civicrm_mailing_event_delivered
where time_stamp < @fecha ;

delete from civicrm_mailing_event_bounce
where time_stamp < @fecha ;

delete from civicrm_job_log
where run_time < @fecha ;

delete from civicrm_log
where modified_date < @fecha ;

delete from civicrm_mailing
where id in ( select mailing_id from temp_mail_job_ids ) ;

delete from civicrm_mailing_job
where id in ( select job_id from temp_mail_job_ids ) ;


create temporary table temp_mailing
select id as mailing_id
from civicrm_mailing
where created_date < @fecha ;

create index temp_mailing_id1 on temp_mailing ( mailing_id ) ;

delete from civicrm_mailing_recipients
where mailing_id in ( select mailing_id from temp_mailing ) ;

delete from civicrm_mailing
where created_date < @fecha ;

select '' AS ' ';
select 'Comienza a optimizar tablas' AS ' ';

optimize table civicrm_mailing_recipients ;
optimize table civicrm_mailing_event_delivered ;
optimize table civicrm_mailing_event_bounce ;
optimize table civicrm_mailing ;
optimize table civicrm_mailing_event_opened ;
optimize table civicrm_mailing_event_queue ;
optimize table civicrm_mailing_event_reply ;
optimize table civicrm_mailing_event_trackable_url_open ;
optimize table civicrm_mailing_job ;
optimize table civicrm_mailing_trackable_url ;
optimize table civicrm_mailing_group ;
optimize table civicrm_mailing_event_unsubscribe ;" | mysql --user=$USER --password=$PASS
