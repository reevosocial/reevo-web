<?php
$it = array (
  'item:site' => 'Siti',
  'login' => 'Entra',
  'loginok' => 'Benvenuto.',
  'loginerror' => 'Non possiamo farti entrare. Questo può accadere perchè non hai ancora convalidato il tuo account, o i dati che hai fornito non sono corretti. Assicurati che i tuoi dati siano corretti e per favore riprova.',
  'logout' => 'Esci',
  'logoutok' => 'Arrivederci.',
  'logouterror' => 'Non possiamo farti uscire. Per favore riprova.',
  'exception:title' => 'Benvenuto in Elgg.',
  'actionundefined' => 'L\'azione che è stata richiesta (%s) non è definita nel sistema.',
  'actionloggedout' => 'Scusaci, non puoi compiere questa azione senza una previa identificazione sul sito.',
  'notfound' => 'Nessun risultato trovato.',
  'SecurityException:Codeblock' => 'Negato l\'accesso privilegiato per l\'esecuzione di codice blocco',
  'DatabaseException:WrongCredentials' => 'Elgg potrebbe non connettersi al database utilizzando le credenziali fornite.',
  'DatabaseException:NoConnect' => 'Elgg non poteva selezionare il database \'%s\', si prega di verificare che il database è stato creato e si ha accesso ad esso.',
  'SecurityException:FunctionDenied' => 'L\'accesso alle funzione privilegiata \'%s\' è negato.',
  'DatabaseException:DBSetupIssues' => 'Ci sono stati un numero di problemi:',
  'DatabaseException:ScriptNotFound' => 'Elgg potrebbe non trovare la richiesta allo script database %s.',
  'IOException:FailedToLoadGUID' => 'Impossibile caricare nuovi %s dall GUID:%d',
  'InvalidParameterException:NonElggObject' => 'Passaggio di un non ElggObject ad un costruttore ElggObject!',
  'InvalidParameterException:UnrecognisedValue' => 'Non riconosciuto valore passato a costruttore.',
  'InvalidClassException:NotValidElggStar' => 'GUID:%d non è un valido %s',
  'PluginException:MisconfiguredPlugin' => '%s è un plugin non configurato.',
  'InvalidParameterException:NonElggUser' => 'Passaggio di un non-ElggUser ad un costruttore ElggUser!',
  'InvalidParameterException:NonElggSite' => 'Passaggio di un non-ElggUser ad un costruttore ElggUser!',
  'InvalidParameterException:NonElggGroup' => 'Passaggio di un non-ElggUser ad un costruttore ElggUser!',
  'IOException:UnableToSaveNew' => 'Inabilitato a salvare il nuovo %s',
  'InvalidParameterException:GUIDNotForExport' => 'Il GUID non è stato specificato durante l\'esportazione, questo non dovrebbe accadere mai.',
  'InvalidParameterException:NonArrayReturnValue' => 'Entità seria la funzione ha superato un parametro non in ordine',
  'ConfigurationException:NoCachePath' => 'La patch della Cache non è impostata!',
  'IOException:NotDirectory' => '%s non è una cartella.',
  'IOException:BaseEntitySaveFailed' => 'Impossibile salvare il nuovo oggetto della base di entita informazioni!',
  'InvalidParameterException:UnexpectedODDClass' => 'importazione ()ha superato un inatteso ODD classe',
  'InvalidParameterException:EntityTypeNotSet' => 'Tipo di entità deve essere impostato.',
  'ClassException:ClassnameNotClass' => '%s non è un %s.',
  'ClassNotFoundException:MissingClass' => 'La classe \'%s\' non è stata trovata, il Plugin è mancante?',
  'InstallationException:TypeNotSupported' => 'Tipo %s non è supportato. Questo significa che c\'è un errore nella tua installazione, molto probabilmente causato da un aggiornamento incompleto.',
  'ImportException:ImportFailed' => 'Non è possibile importare l\'elemento %d',
  'ImportException:ProblemSaving' => 'C\'è stato un problema nell\'importare %s',
  'ImportException:NoGUID' => 'Una nuova entità è stata creata ma non ha un GUID, questo non dovrebbe accadere.',
  'ImportException:GUIDNotFound' => 'L\'entità \'%d\' non può essere trovata.',
  'ImportException:ProblemUpdatingMeta' => 'C\'è stato un problema nell\'aggiornare \'%s\' sull\'entità \'%d\'',
  'ExportException:NoSuchEntity' => 'Nessuna entità GUID simile:%d',
  'ImportException:NoODDElements' => 'Nessun elemento OpenDD è stato trovato nell\'importazione dei dati, l\'importazione è fallita.',
  'ImportException:NotAllImported' => 'Non tutti gli elementi sono stati importati.',
  'InvalidParameterException:UnrecognisedFileMode' => 'Modalità file non riconosciuta \'%s\'',
  'InvalidParameterException:MissingOwner' => 'Tutti i file devono avere un proprietario!',
  'IOException:CouldNotMake' => 'Non si può fare %s',
  'IOException:MissingFileName' => 'Devi specificare un nome prima di aprire un file.',
  'ClassNotFoundException:NotFoundNotSavedWithFile' => 'La cartella per il deposito dei File non è stata trovata o la classe non è stata salvata con un file!',
  'NotificationException:NoNotificationMethod' => 'Nessun metodo di notificazione è stato specificato.',
  'NotificationException:NoHandlerFound' => 'Nessun gestore trovati per \'%s\' o non è stato collocato.',
  'NotificationException:ErrorNotifyingGuid' => 'Si è verificato un errore durante la comunicazione %d',
  'NotificationException:NoEmailAddress' => 'Non posso ottenere l\'indirizzo email per il GUID:%d',
  'NotificationException:MissingParameter' => 'Manca un parametro richiesto, \'%s\'',
  'DatabaseException:WhereSetNonQuery' => 'Se non impostato Dove contiene Componente Query',
  'DatabaseException:SelectFieldsMissing' => 'I campi mancanti su una query per selezionare lo stile',
  'DatabaseException:UnspecifiedQueryType' => 'Non riconosciuto o non specificato tipo di richiesta.',
  'DatabaseException:NoTablesSpecified' => 'Non specificato tabelle per query.',
  'DatabaseException:NoACL' => 'Controllo di accesso non è stato fornito su richiesta',
  'InvalidParameterException:NoEntityFound' => 'Nessuna entità trovata, o non esiste o non hai accesso ad essa.',
  'InvalidParameterException:GUIDNotFound' => 'GUID:%s non può essere trovato, o non è possibile accedere.',
  'InvalidParameterException:IdNotExistForGUID' => 'Spiacente, \'%s\' non esiste per la guid:%d',
  'InvalidParameterException:CanNotExportType' => 'Spiacente, Non so come esportare \'%s\'',
  'InvalidParameterException:NoDataFound' => 'Impossibile trovare i dati.',
  'InvalidParameterException:DoesNotBelong' => 'Non appartengono a entità.',
  'InvalidParameterException:DoesNotBelongOrRefer' => 'Non appartengono o si riferiscono a entità.',
  'InvalidParameterException:MissingParameter' => 'Parametro mancante, è necessario fornire un GUID.',
  'SecurityException:APIAccessDenied' => 'Siamo spiacenti, l\' API di accesso è stato disattivato dagli amministratori.',
  'SecurityException:NoAuthMethods' => 'Metodi di autenticazione non è stato trovato che possa autenticare questa richiesta API.',
  'APIException:ApiResultUnknown' => 'API dei risultati è di un tipo sconosciuto, questo non dovrebbe mai accadere.',
  'ConfigurationException:NoSiteID' => 'ID del sito non è stato specificato.',
  'APIException:MissingParameterInMethod' => 'Parametro mancante %s in metodo %s',
  'APIException:ParameterNotArray' => '%s non sembra essere un array.',
  'APIException:UnrecognisedTypeCast' => 'Non riconosciuti tipo espressi in %s per la variabile \'%s\' in metodo \'%s\'',
  'APIException:InvalidParameter' => 'Parametro non valido trovato per\' %s\' in metodo \'%s\'.',
  'APIException:FunctionParseError' => '%s(%s) ha un errore di parsing.',
  'APIException:FunctionNoReturn' => '%s(%s) non ha restituito alcun valore.',
  'SecurityException:AuthTokenExpired' => 'Dati di autenticazione mancanti, non validi o scaduti.',
  'CallException:InvalidCallMethod' => '%s deve essere chiamato con \'%s\'',
  'APIException:MethodCallNotImplemented' => 'Metodo di chiamata \'%s\' non   stato attuato.',
  'APIException:AlgorithmNotSupported' => 'Algoritmo \'%s\' non è supportato o è stato disabilitato.',
  'ConfigurationException:CacheDirNotSet' => 'Directory Cache  \'cache_path\' non impostata.',
  'APIException:NotGetOrPost' => 'Metodo deve essere richiesta GET o POST',
  'APIException:MissingAPIKey' => 'Mancante X-Elgg-apikey HTTP in testa',
  'APIException:MissingHmac' => 'Mancante X-Elgg-hmac in testa',
  'APIException:MissingHmacAlgo' => 'Mancante X-Elgg-hmac-algo in testa',
  'APIException:MissingTime' => 'Mancante X-Elgg-time in testa',
  'APIException:TemporalDrift' => 'X-Elgg-tempo troppo lontano nel passato o futuro. Epoca non.',
  'APIException:NoQueryString' => 'Non sono disponibili dati sulla stringa di ricerca',
  'APIException:MissingPOSTHash' => 'Mancante X-Elgg-posthash in testa',
  'APIException:MissingPOSTAlgo' => 'Mancante X-Elgg-posthash_algo in testa',
  'APIException:MissingContentType' => 'Mancante tipo di contenuto per il post dei dati',
  'SecurityException:InvalidPostHash' => 'POST hash dei dati non valido - Prevista %s ma si %s.',
  'SecurityException:DupePacket' => 'Tipo di firma già visto.',
  'SecurityException:InvalidAPIKey' => 'Non valido o mancante API Key.',
  'NotImplementedException:CallMethodNotImplemented' => 'Metodo di chiamata \'%s\' non è attualmente supportato.',
  'NotImplementedException:XMLRPCMethodNotImplemented' => 'XML-RPC Metodo di chiamata \'%s\' non implementato.',
  'InvalidParameterException:UnexpectedReturnFormat' => 'Metodo di chiamata \'%s\' ha restituito un risultato inaspettato.',
  'CallException:NotRPCCall' => 'Non sembra essere una valida chiamata XML-RPC',
  'PluginException:NoPluginName' => 'Il nome plugin non è stato possibile trovare',
  'SecurityException:authenticationfailed' => 'L\'utente potrebbe non essere autenticato',
  'CronException:unknownperiod' => '%s non è un periodo riconosciuto.',
  'SecurityException:deletedisablecurrentsite' => 'Non è possibile eliminare o disabilitare il sito che si sta visualizzando!',
  'memcache:notinstalled' => 'PHP Memcache modulo non è installato, è necessario installare php5-Memcache',
  'memcache:noservers' => 'Memcache server non definiti, si prega di compilare il  variable',
  'memcache:versiontoolow' => 'Memcache ha bisogno di almeno versione %s al termine, si esegue %s',
  'memcache:noaddserver' => 'Supporto di più server disabili, potrebbe essere necessario aggiornare la tua libreria PECL Memcache',
  'deprecatedfunction' => 'Avvertenza: Questo codice utilizza la funzione deprecata \'%s\' e non è compatibile con questa versione di Elgg',
  'pageownerunavailable' => 'Attenzione: la pagina proprietaria %d non è accessibile',
  'system.api.list' => 'Elenca tutte le chiamate API disponibili sul sistema.',
  'auth.gettoken' => 'Questa chiamata API consente a un utente di accedere, restituire un token di autenticazione che può essere utilizzato in leu di un nome utente e la password per l\'autenticazione chiede inoltre.',
  'name' => 'Nome mostrato',
  'email' => 'Indirizzo Email',
  'username' => 'Username',
  'password' => 'Password',
  'passwordagain' => 'Password (di nuovo per verifica)',
  'admin_option' => 'Rendere questo utente un amministratore ?',
  'PRIVATE' => 'Privato',
  'LOGGED_IN' => 'Utenti loggati',
  'PUBLIC' => 'Pubblico',
  'access:friends:label' => 'Amici',
  'access' => 'Accesso',
  'dashboard' => 'Home',
  'dashboard:nowidgets' => 'La tua Homepage da l\'inizio del sito. Fare clic su \'Modifica pagina\' per aggiungere i gadget per tenere traccia del contenuto e la vita all\'interno del sistema.',
  'widgets:add' => 'Aggiungi i gadget alla tua pagina',
  'widgets:add:description' => 'Scegli le caratteristiche che si desidera aggiungere alla tua pagina trascinandoli dalla <b>Galleria gadget</b> sulla destra, ad una delle tre aree gadget qui sotto, scegliendo la posizione dove si desidera che vengano visualizzati.



Per rimuovere un gadget trascinarlo nella <b>Galleria gadget</b>.',
  'widgets:position:fixed' => '(Fissa posizione nella pagina)',
  'widgets' => 'Gadgets',
  'widget' => 'Gadgets',
  'item:object:widget' => 'Gadgets',
  'widgets:save:success' => 'I tuoi gadget sono stati salvati con successo.',
  'widgets:save:failure' => 'Problema nel salvare i tuoi gadget, riprova più tardi.',
  'group' => 'Gruppo',
  'item:group' => 'Gruppi',
  'profile:edit:default' => 'Riempire i campi profilo',
  'user' => 'Utente',
  'item:user' => 'Utenti',
  'riveritem:single:user' => 'un utente',
  'riveritem:plural:user' => 'alcuni utenti',
  'profile:edit' => 'Modifca profilo',
  'profile:aboutme' => 'Informazioni su di me',
  'profile:description' => 'Informazioni su di me',
  'profile:briefdescription' => 'Breve descrizione',
  'profile:location' => 'Dove abito',
  'profile:skills' => 'In cosa sono abile',
  'profile:interests' => 'Interessi',
  'profile:contactemail' => 'Contatto email',
  'profile:phone' => 'Telefono',
  'profile:mobile' => 'Cellulare',
  'profile:website' => 'Sito internet',
  'profile:label' => 'Nome profilo',
  'profile:type' => 'Tipo profilo',
  'profile:editdefault:fail' => 'Il profilo di default non e stato salvato',
  'profile:editdefault:success' => 'Voce correttamente aggiunta al profilo di default',
  'profile:editdefault:delete:fail' => 'Rimosso profilo predefinito voce campo non assegnato',
  'profile:editdefault:delete:success' => 'Profilo predefinito punto cancellato!',
  'profile:defaultprofile:reset' => 'Resetta profilo default del sistema',
  'profile:resetdefault' => 'Resetta profilo default',
  'profile:explainchangefields' => 'È possibile sostituire i campi già esistenti con il proprio profilo utilizzando il modulo seguente. In primo luogo si dà il nuovo campo profilo di una etichetta, ad esempio, \'squadra del cuore\'. Dopodiché è necessario selezionare il tipo di campo, per esempio, i tag, url, testo e così via. In qualsiasi momento puoi tornare al profilo di default',
  'profile:saved' => 'Profilo salvato con successo.',
  'friends' => 'Amici',
  'friends:yours' => 'I tuoi amici',
  'friends:owned' => '%s amici',
  'friend:add' => 'Aggiungi un amico',
  'friend:remove' => 'Rimuovi un amico',
  'friends:add:successful' => 'Hai correttamente aggiunto %s come amico.',
  'friends:add:failure' => 'Impossibile aggiungere %s come amico. Si prega di riprovare.',
  'friends:remove:successful' => 'Hai correttamente rimosso %s dai tuoi amici.',
  'friends:remove:failure' => 'Impossibile rimuovere %s dai tuoi amici. Si prega di riprovare.',
  'friends:none' => 'Questo utente non ha aggiunto ancora qualcuno come amico.',
  'friends:none:you' => 'Non hai aggiunto qualcuno come amico! Cerca il tuo interesse per iniziare la ricerca di persone da seguire.',
  'friends:none:found' => 'Non sono stati trovati amici.',
  'friends:of:none' => 'Nessuno ha aggiunto questo utente come amico ancora.',
  'friends:of:none:you' => 'Nessuno ti ha aggiunto come amico ancora. Inizia aggiungendo contenuti e compila il tuo profilo, per farti trovare!',
  'friends:of:owned' => 'Persone che hanno fatto %s un amico',
  'friends:num_display' => 'Numero di amici da visualizzare',
  'friends:icon_size' => 'Dimensione immagine',
  'friends:tiny' => 'Piccolissima',
  'friends:small' => 'Piccola',
  'friends:of' => 'Amici di',
  'friends:collections' => 'Gruppi di amici',
  'friends:collections:add' => 'Nuovo gruppo di amici',
  'friends:addfriends' => 'Aggiungi amici',
  'friends:collectionname' => 'Nome gruppo',
  'friends:collectionfriends' => 'Amici nel gruppo',
  'friends:collectionedit' => 'Modifica questo gruppo',
  'friends:nocollections' => 'Non hai ancora un gruppo.',
  'friends:collectiondeleted' => 'Il tuo gruppo e stato cancellato.',
  'friends:collectiondeletefailed' => 'Non siamo stati in grado di eliminare il gruppo. O non hai il permesso, o qualche altro problema si verifica.',
  'friends:collectionadded' => 'Il tuo gruppo e stato creato con successo',
  'friends:nocollectionname' => 'Necessario dare un nome al tuo gruppo prima che possa essere creato.',
  'friends:collections:members' => 'Membri del gruppo',
  'friends:collections:edit' => 'Modifica il gruppo',
  'friendspicker:chararray' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
  'feed:rss' => 'Iscriviti al feed',
  'link:view' => 'visita link',
  'river' => 'Canale',
  'river:noaccess' => 'Non hai i permessi per visualizzare questo articolo.',
  'river:posted:generic' => '%s ha inviato',
  'plugins:settings:save:ok' => 'Le impostazioni per il plugin %s sono state salvate con successo.',
  'plugins:settings:save:fail' => 'Problema per il salvataggio delle impostazioni %s plugin.',
  'plugins:usersettings:save:ok' => 'Impostazioni per utente %s plugin sono state salvate con successo.',
  'plugins:usersettings:save:fail' => 'Problema per salvare le impostazioni per utente %s plugin.',
  'admin:plugins:label:version' => 'Versione',
  'item:object:plugin' => 'Impostazioni di configurazione plugin',
  'notifications:usersettings' => 'Impostazioni notifiche',
  'notifications:methods' => 'Si prega di specificare quali metodi si desidera consentire.',
  'notifications:usersettings:save:ok' => 'Le impostazioni di notifica sono state salvate.',
  'notifications:usersettings:save:fail' => 'Problema nel salvare le impostazioni di notifica.',
  'user.notification.get' => 'Torna alle impostazioni di notifica per un determinato utente.',
  'user.notification.set' => 'Impostare le impostazioni di notifica per un determinato utente.',
  'search' => 'Cerca',
  'searchtitle' => 'Cerca: %s',
  'users:searchtitle' => 'Ricerca per utenti: %s',
  'groups:searchtitle' => 'Ricerca per gruppi: %s',
  'advancedsearchtitle' => '%s con i risultati corrispondenti %s',
  'next' => 'Successivo',
  'previous' => 'Precedente',
  'viewtype:change' => 'Cambia tipo di lista',
  'viewtype:list' => 'Elenco',
  'viewtype:gallery' => 'Galleria',
  'tag:search:startblurb' => 'Elementi con tag corrispondenti \'%s\':',
  'user:search:startblurb' => 'Utenti corrispondenti \'%s\':',
  'user:search:finishblurb' => 'Per vedere tutto, clicca qui.',
  'group:search:startblurb' => 'Gruppi individuati \'%s\'',
  'group:search:finishblurb' => 'Mostra ancora, clicca qui.',
  'search:go' => 'Vai',
  'account' => 'Profilo',
  'settings' => 'Impostazioni',
  'tools' => 'Strumenti',
  'register' => 'Registrati',
  'registerok' => 'Sei correttamente registrato come %s.',
  'registerbad' => 'La tua registrazione e\' stata rifiutata, il nickname esiste di già, la password e\' corta o sbagliata, riprova.',
  'registerdisabled' => 'La registrazione e stata disabilitata dall\'amministratore del sistema',
  'registration:notemail' => 'Indirizzo email che hai fornito non sembra essere un indirizzo email valido.',
  'registration:userexists' => 'Questo nome utente esiste , prova con un altro',
  'registration:usernametooshort' => 'Il tuo nome utente deve essere un minimo di 4 caratteri.',
  'registration:passwordtooshort' => 'La password deve essere un minimo di 6 caratteri.',
  'registration:dupeemail' => 'Questo indirizzo email e già stato registrato.',
  'registration:invalidchars' => 'Siamo spiacenti, il tuo nome utente contiene caratteri non validi.',
  'registration:emailnotvalid' => 'Siamo spiacenti, indirizzo email inserito non valido su questo sistema',
  'registration:passwordnotvalid' => 'Siamo spiacenti, password inserita non valida su questo sistema',
  'registration:usernamenotvalid' => 'Siamo spiacenti, nome utente inserito non valido su questo sistema',
  'adduser' => 'Aggiungi utente',
  'adduser:ok' => 'Hai aggiunto correttamente un nuovo utente.',
  'adduser:bad' => 'Il nuovo utente non puo essere creato.',
  'user:set:name' => 'Nome account impostazioni',
  'user:name:label' => 'Il tuo nome',
  'user:name:success' => 'Cambiato con successo il tuo nome sul sistema.',
  'user:name:fail' => 'Impossibile cambiare il tuo nome sul sistema.',
  'user:set:password' => 'Password Account',
  'user:password:label' => 'La tua nuova password',
  'user:password2:label' => 'La tua nuova password (di nuovo)',
  'user:password:success' => 'Password cambiata',
  'user:password:fail' => 'Impossibile cambiare la password del sistema.',
  'user:password:fail:notsame' => 'Le due password non sono la stessa cosa!',
  'user:password:fail:tooshort' => 'La password e troppo breve!',
  'user:set:language' => 'Impostazioni lingua',
  'user:language:label' => 'La tua lingua',
  'user:language:success' => 'Le impostazioni della lingua sono state aggiornati.',
  'user:language:fail' => 'Le impostazioni della lingua non possono essere salvate.',
  'user:username:notfound' => 'Utente %s non trovato.',
  'user:password:lost' => 'Hai dimenticato la password',
  'user:password:resetreq:success' => 'Hai chiesto una nuova password, e-mail inviata con successo',
  'user:password:resetreq:fail' => 'Non puoi richiedere una nuova password.',
  'user:password:text' => 'Per generare una nuova password scrivi qui sotto il tuo nome utente ti invieremo una pagina contenente il link di attivazione.',
  'user:persistent' => 'Ricordati',
  'admin:configuration:success' => 'Le tue impostazioni sono state salvate.',
  'admin:configuration:fail' => 'Le tue impostazioni non possono essere salvate.',
  'admin' => 'Amministrazione',
  'admin:description' => 'Il pannello di amministrazione permette di controllare tutti gli aspetti del sistema, dalla gestione degli utenti ai comportamenti delle plugin. Scegli una delle seguenti opzioni per iniziare.',
  'admin:site:description' => 'Questo pannello di amministrazione permette di controllare le impostazioni globali per il tuo sito. Scegli una delle seguenti opzioni per iniziare.',
  'admin:site:opt:linktext' => 'Configura sito...',
  'admin:site:access:warning' => 'Cambiare impostazione di accesso riguarda solo le autorizzazioni per i contenuti creati in futuro.',
  'admin:plugins' => 'Amministrazione plugin',
  'admin:plugins:description' => 'Questo pannello di amministrazione permette di controllare e configurare le plugin installate sul tuo sito.',
  'admin:plugins:opt:linktext' => 'Configurazione strumenti...',
  'admin:plugins:opt:description' => 'Configurare gli strumenti installati sul sito.',
  'admin:plugins:label:author' => 'Autore',
  'admin:plugins:label:copyright' => 'Copyright',
  'admin:plugins:label:licence' => 'Licenza',
  'admin:plugins:label:website' => 'URL',
  'admin:plugins:label:moreinfo' => 'alte informazioni',
  'admin:statistics' => 'Statistiche',
  'admin:statistics:description' => 'Questa è una panoramica delle statistiche sul tuo sito.',
  'admin:statistics:opt:description' => 'Visualizza le informazioni e statistiche sugli utenti e gli oggetti sul tuo sito.',
  'admin:statistics:opt:linktext' => 'Visualizza statistiche...',
  'admin:statistics:label:basic' => 'Statistiche di base del sito',
  'admin:statistics:label:numentities' => 'Attività del sito',
  'admin:statistics:label:numusers' => 'Numero di utenti',
  'admin:statistics:label:numonline' => 'Numero di utenti online',
  'admin:statistics:label:onlineusers' => 'Utenti online',
  'admin:statistics:label:version' => 'Versione di Elgg',
  'admin:statistics:label:version:release' => 'Rilascio',
  'admin:statistics:label:version:version' => 'Versione',
  'admin:user:label:search' => 'Trova utenti:',
  'admin:user:ban:no' => 'Non può bannare utente',
  'admin:user:ban:yes' => 'Utente bannato.',
  'admin:user:unban:no' => 'Non può togliere il ban a utente',
  'admin:user:unban:yes' => 'Utente tolto dal ban.',
  'admin:user:delete:no' => 'Non può cancellare utente',
  'admin:user:delete:yes' => 'Utente cancellato',
  'admin:user:resetpassword:yes' => 'Reimpostazione della password, notificato a utente.',
  'admin:user:resetpassword:no' => 'Password non ripristinabile.',
  'admin:user:makeadmin:yes' => 'Questo utente è un amministratore.',
  'admin:user:makeadmin:no' => 'Non siamo riusciti a rendere questo utente un amministratore.',
  'admin:user:removeadmin:yes' => 'Questo utente non è più un amministratore.',
  'admin:user:removeadmin:no' => 'Non siamo riusciti a rimuovere i privilegi di amministratore di questo utente.',
  'usersettings:description' => 'Le impostazioni utente pannello vi permette di controllare tutte le tue impostazioni personali, dalla gestione degli utenti a comportarsi come plugin. Scegli una delle seguenti opzioni per iniziare.',
  'usersettings:statistics' => 'Le tue statistiche',
  'usersettings:statistics:opt:description' => 'Visualizza le informazioni statistiche sugli utenti e gli oggetti sul tuo sito.',
  'usersettings:statistics:opt:linktext' => 'Statistiche Account',
  'usersettings:user' => 'Le tue impostazioni',
  'usersettings:user:opt:description' => 'Consente di controllare le impostazioni utente.',
  'usersettings:user:opt:linktext' => 'Cambia le tue impostazioni',
  'usersettings:plugins' => 'Strumenti',
  'usersettings:plugins:opt:description' => 'Configurare le impostazioni (se del caso) per la vostra attiva strumenti.',
  'usersettings:plugins:opt:linktext' => 'Configura i tuoi strumenti',
  'usersettings:plugins:description' => 'Questo pannello permette di controllare e configurare le impostazioni personali e gli strumenti installati dal vostro amministratore di sistema.',
  'usersettings:statistics:label:numentities' => 'Le tue attività',
  'usersettings:statistics:yourdetails' => 'I tuoi dati',
  'usersettings:statistics:label:name' => 'Nome completo',
  'usersettings:statistics:label:email' => 'Email',
  'usersettings:statistics:label:membersince' => 'Iscritto dal',
  'usersettings:statistics:label:lastlogin' => 'Ultimo ingresso',
  'save' => 'Salva',
  'publish' => 'Pubblica',
  'cancel' => 'Annulla',
  'saving' => 'Salvataggio ...',
  'update' => 'Aggiorna',
  'edit' => 'Modifica',
  'delete' => 'Cancella',
  'accept' => 'Accetta',
  'load' => 'Carica',
  'upload' => 'Invia',
  'ban' => 'Banna',
  'unban' => 'Togli ban',
  'enable' => 'Abilita',
  'disable' => 'Disabilita',
  'request' => 'Richiedi',
  'complete' => 'Completa',
  'open' => 'Apri',
  'close' => 'Chiudi',
  'reply' => 'Rispondi',
  'more' => 'Altro',
  'comments' => 'Commenti',
  'import' => 'Importa',
  'export' => 'Esporta',
  'up' => 'Sopra',
  'down' => 'Sotto',
  'top' => 'Alto',
  'bottom' => 'Basso',
  'invite' => 'Invita',
  'resetpassword' => 'Resetta la password',
  'makeadmin' => 'Rendi admin',
  'removeadmin' => 'Togli admin',
  'option:yes' => 'Si',
  'option:no' => 'No',
  'unknown' => 'Sconosciuto',
  'active' => 'Attivo',
  'total' => 'Totale',
  'learnmore' => 'Clicca qui per sapere altro.',
  'content' => 'contenuto',
  'content:latest' => 'Ultime attività',
  'content:latest:blurb' => 'In alternativa, fare clic qui per visualizzare il contenuto piu recente di tutto il sito.',
  'link:text' => 'vedi il link',
  'question:areyousure' => 'Sei sicuro ?',
  'title' => 'Titolo',
  'description' => 'Descrizione',
  'tags' => 'Tag',
  'spotlight' => 'In primo piano',
  'all' => 'Tutti',
  'by' => 'da',
  'annotations' => 'Annotazioni',
  'relationships' => 'Relazioni',
  'metadata' => 'Metadati',
  'deleteconfirm' => 'Sei sicuro di voler eliminare questa voce?',
  'fileexists' => 'Un file è già stato caricato. Per sostituirlo, selezionare il testo qui sotto:',
  'useradd:subject' => 'Account utente creato',
  'useradd:body' => '%s,



Un account utente e\' stato creato per te %s. Per accedere, visitare:



	%s



E accedere con queste credenziali utente:



	Username: %s

	Password: %s

	

Dopo aver effettuato un accesso, si consiglia di cambiare la tua password.',
  'systemmessages:dismiss' => 'Clicca per annullare',
  'importsuccess' => 'Importazione di dati riuscita',
  'importfail' => 'Importazione di dati fallita.',
  'friendlytime:justnow' => 'adesso',
  'friendlytime:minutes' => '%s minuti fa',
  'friendlytime:minutes:singular' => 'un minuto fa',
  'friendlytime:hours' => '%s ore fa',
  'friendlytime:hours:singular' => 'un ora fa',
  'friendlytime:days' => '%s giorni fa',
  'friendlytime:days:singular' => 'ieri',
  'date:month:01' => 'Gennaio %s',
  'date:month:02' => 'Febbraio %s',
  'date:month:03' => 'Marzo %s',
  'date:month:04' => 'Aprile %s',
  'date:month:05' => 'Maggio %s',
  'date:month:06' => 'Giugno %s',
  'date:month:07' => 'Luglio %s',
  'date:month:08' => 'Agosto %s',
  'date:month:09' => 'Settembre %s',
  'date:month:10' => 'Ottobre %s',
  'date:month:11' => 'Novembre %s',
  'date:month:12' => 'Dicembre %s',
  'installation:sitename' => 'Il nome del tuo sito (es "Il mio sito di social networking"):',
  'installation:sitedescription' => 'Breve descrizione del tuo sito (opzionale)',
  'installation:wwwroot' => 'URL del sito, seguita da una barra:',
  'installation:path' => 'Il percorso completo del tuo sito in root sul vostro hosting, seguito da una barra:',
  'installation:dataroot' => 'Intero percorso della directory dove i file caricati verranno memorizzati, seguita da una barra:',
  'installation:dataroot:warning' => 'E necessario creare manualmente questa directory. Essa dovrebbe trovarsi in una directory diversa della vostra installazione Elgg.',
  'installation:sitepermissions' => 'Le autorizzazioni di accesso predefinite:',
  'installation:language' => 'La lingua predefinita per il tuo sito:',
  'installation:debug' => 'Il debug mode fornisce informazioni supplementari che possono essere utilizzate per diagnosticare guasti, tuttavia si puo rallentare il vostro sistema deve essere utilizzato solo se si verificano problemi:',
  'installation:httpslogin' => 'Abilita questo utente ad avere accesso tramite HTTPS. Avrete bisogno di avere https abilitato sul server.',
  'installation:httpslogin:label' => 'Abilita HTTPS login',
  'installation:view' => 'Inserisci la vista principale che sara utilizzato come impostazione predefinita per il tuo sito o lasciare questo spazio vuoto per la visualizzazione predefinita (in caso di dubbio, lasciare il default):',
  'installation:siteemail' => 'Indirizzo e-mail del sito (sistema utilizzato per invio di e-mail)',
  'installation:disableapi' => 'Il RESTful API flessibile ed estensibile che consente alle applicazioni di interfaccia per utilizzo di determinate funzioni a distanza Elgg.',
  'installation:disableapi:label' => 'Abilita il RESTful API',
  'installation:allow_user_default_access:description' => 'Se selezionato, i singoli utenti sono autorizzati a fissare i loro livello di accesso di default e possono accedere a il sistema oltre il livello di accesso predefinito.',
  'installation:allow_user_default_access:label' => 'Consentire agli utenti accesso predefinito',
  'installation:simplecache:description' => 'Il semplice aumento delle prestazioni della cache da caching statico il contenuto, compresi alcuni file CSS e JavaScript. Normalmente si desidera questo.',
  'installation:simplecache:label' => 'Usa semplice cache',
  'upgrading' => 'Aggiornamento',
  'upgrade:db' => 'Il database e stato aggiornato.',
  'upgrade:core' => 'La vostra installazione di Elgg e stata aggiornata',
  'welcome' => 'Benvenuto',
  'welcome:user' => 'Benvenuto %s',
  'email:settings' => 'Impostazioni e-mail',
  'email:address:label' => 'Il tuo indirizzo e-mail',
  'email:save:success' => 'Nuovo indirizzo e-mail salvato, richiesta una verifica.',
  'email:save:fail' => 'Il tuo nuovo indirizzo di posta elettronica non poteva essere salvato.',
  'friend:newfriend:subject' => '%s ha fatto di voi un amico!',
  'friend:newfriend:body' => '%s ha fatto di voi un amico!



Per visualizzare il loro profilo, clicca qui:



	%s



Impossibile rispondere a questa e-mail.',
  'email:resetpassword:subject' => 'Reimpostazione della password!',
  'email:resetpassword:body' => 'Salve %s,

			

La tua password e\' stata reimpostata a: %s',
  'email:resetreq:subject' => 'Richiesta di nuova password.',
  'email:resetreq:body' => 'Salve %s,

			

Qualcuno (da questo indirizzo IP %s) ha chiesto una nuova password per questo account.



Se hai richiesto tu il cambio password, fai clic sul link qui sotto, altrimenti ignora questa e-mail.



%s

',
  'default_access:settings' => 'Il tuo livello di accesso predefinito',
  'default_access:label' => 'Accesso predefinito',
  'user:default_access:success' => 'Il tuo nuovo livello di accesso è stato salvato.',
  'user:default_access:failure' => 'Il tuo nuovo livello di accesso non è stato salvato.',
  'xmlrpc:noinputdata' => 'Inserisci dati mancanti',
  'comments:count' => '%s commenti',
  'riveraction:annotation:generic_comment' => '%s commenta %s',
  'generic_comments:add' => 'Aggiungi un commento',
  'generic_comments:text' => 'Commenta',
  'generic_comment:posted' => 'Commento inviato con successo.',
  'generic_comment:deleted' => 'Il tuo commento e\' stato eliminato.',
  'generic_comment:blank' => 'Siamo spiacenti, hai bisogno di scrivere qualcosa nell commento prima di di salvare.',
  'generic_comment:notfound' => 'Siamo spiacenti, non siamo riusciti a trovare oggetto specificato.',
  'generic_comment:notdeleted' => 'Siamo spiacenti, non abbiamo potuto eliminare questo commento.',
  'generic_comment:failure' => 'Un errore imprevisto si verifica quando aggiungi il tuo commento. Si prega di riprovare.',
  'generic_comment:email:subject' => 'Hai un nuovo commento!',
  'generic_comment:email:body' => 'Hai un nuovo commento sul tuo articolo "%s" from %s. Si legge:



			

%s





Per rispondere o per visualizzare, clicca qui:



	%s



Per visualizzare %s\'s profilo, clicca qui:



	%s



Impossibile rispondere a questa e-mail.',
  'entity:default:strapline' => 'Creato %s da %s',
  'entity:default:missingsupport:popup' => 'Questo oggetto non pu� essere visualizzato correttamente. Cio puo essere dovuto al fatto che esso richiede il supporto fornito da un plugin che non � piu installata.',
  'entity:delete:success' => 'Oggetto %s e stato cancellato',
  'entity:delete:fail' => 'Oggetto %s non puo essere cancellato',
  'actiongatekeeper:missingfields' => 'Manca un  simbolo o campo',
  'actiongatekeeper:tokeninvalid' => 'Si e verificato un errore (di disallineamento). Questo probabilmente significa che la pagina che si stava utilizzando e scaduta. Si prega di riprovare.',
  'actiongatekeeper:timeerror' => 'La pagina che si stava utilizzando e scaduta. Si prega di aggiornare e riprovare.',
  'actiongatekeeper:pluginprevents' => 'Una estensione ha impedito che questo possa essere presentata sotto forma di.',
  'word:blacklist' => 'e, la, allora, ma, lei, la sua, lei, lui, uno, e non, anche, su, ora, di conseguenza, tuttavia, ancora, allo stesso modo, altrimenti, quindi, per converso, invece, di conseguenza, inoltre, tuttavia, invece, nel frattempo, di conseguenza, questa, sembra, che cosa, chi, di cui, chiunque.',
  'aa' => 'Afar',
  'ab' => 'Abkhazian',
  'af' => 'Afrikaans',
  'am' => 'Amharic',
  'ar' => 'Arabic',
  'as' => 'Assamese',
  'ay' => 'Aymara',
  'az' => 'Azerbaijani',
  'ba' => 'Bashkir',
  'be' => 'Byelorussian',
  'bg' => 'Bulgarian',
  'bh' => 'Bihari',
  'bi' => 'Bislama',
  'bn' => 'Bengali; Bangla',
  'bo' => 'Tibetan',
  'br' => 'Breton',
  'ca' => 'Catalan',
  'co' => 'Corsican',
  'cs' => 'Czech',
  'cy' => 'Welsh',
  'da' => 'Danish',
  'de' => 'German',
  'dz' => 'Bhutani',
  'el' => 'Greek',
  'en' => 'English',
  'eo' => 'Esperanto',
  'es' => 'Spanish',
  'et' => 'Estonian',
  'eu' => 'Basque',
  'fa' => 'Persian',
  'fi' => 'Finnish',
  'fj' => 'Fiji',
  'fo' => 'Faeroese',
  'fr' => 'French',
  'fy' => 'Frisian',
  'ga' => 'Irish',
  'gd' => 'Scots / Gaelic',
  'gl' => 'Galician',
  'gn' => 'Guarani',
  'gu' => 'Gujarati',
  'he' => 'Hebrew',
  'ha' => 'Hausa',
  'hi' => 'Hindi',
  'hr' => 'Croatian',
  'hu' => 'Hungarian',
  'hy' => 'Armenian',
  'ia' => 'Interlingua',
  'id' => 'Indonesian',
  'ie' => 'Interlingue',
  'ik' => 'Inupiak',
  'is' => 'Icelandic',
  'it' => 'Italian',
  'iu' => 'Inuktitut',
  'iw' => 'Hebrew (obsolete)',
  'ja' => 'Japanese',
  'ji' => 'Yiddish (obsolete)',
  'jw' => 'Javanese',
  'ka' => 'Georgian',
  'kk' => 'Kazakh',
  'kl' => 'Greenlandic',
  'km' => 'Cambodian',
  'kn' => 'Kannada',
  'ko' => 'Korean',
  'ks' => 'Kashmiri',
  'ku' => 'Kurdish',
  'ky' => 'Kirghiz',
  'la' => 'Latin',
  'ln' => 'Lingala',
  'lo' => 'Laothian',
  'lt' => 'Lithuanian',
  'lv' => 'Latvian/Lettish',
  'mg' => 'Malagasy',
  'mi' => 'Maori',
  'mk' => 'Macedonian',
  'ml' => 'Malayalam',
  'mn' => 'Mongolian',
  'mo' => 'Moldavian',
  'mr' => 'Marathi',
  'ms' => 'Malay',
  'mt' => 'Maltese',
  'my' => 'Burmese',
  'na' => 'Nauru',
  'ne' => 'Nepali',
  'nl' => 'Dutch',
  'no' => 'Norwegian',
  'oc' => 'Occitan',
  'om' => '(Afan) Oromo',
  'or' => 'Oriya',
  'pa' => 'Punjabi',
  'pl' => 'Polish',
  'ps' => 'Pashto / Pushto',
  'pt' => 'Portuguese',
  'qu' => 'Quechua',
  'rm' => 'Rhaeto-Romance',
  'rn' => 'Kirundi',
  'ro' => 'Romanian',
  'ru' => 'Russian',
  'rw' => 'Kinyarwanda',
  'sa' => 'Sanskrit',
  'sd' => 'Sindhi',
  'sg' => 'Sangro',
  'sh' => 'Serbo-Croatian',
  'si' => 'Singhalese',
  'sk' => 'Slovak',
  'sl' => 'Slovenian',
  'sm' => 'Samoan',
  'sn' => 'Shona',
  'so' => 'Somali',
  'sq' => 'Albanian',
  'sr' => 'Serbian',
  'ss' => 'Siswati',
  'st' => 'Sesotho',
  'su' => 'Sundanese',
  'sv' => 'Swedish',
  'sw' => 'Swahili',
  'ta' => 'Tamil',
  'te' => 'Tegulu',
  'tg' => 'Tajik',
  'th' => 'Thai',
  'ti' => 'Tigrinya',
  'tk' => 'Turkmen',
  'tl' => 'Tagalog',
  'tn' => 'Setswana',
  'to' => 'Tonga',
  'tr' => 'Turkish',
  'ts' => 'Tsonga',
  'tt' => 'Tatar',
  'tw' => 'Twi',
  'ug' => 'Uigur',
  'uk' => 'Ukrainian',
  'ur' => 'Urdu',
  'uz' => 'Uzbek',
  'vi' => 'Vietnamese',
  'vo' => 'Volapuk',
  'wo' => 'Wolof',
  'xh' => 'Xhosa',
  'yi' => 'Yiddish',
  'yo' => 'Yoruba',
  'za' => 'Zuang',
  'zh' => 'Chinese',
  'zu' => 'Zulu',
  'loggedinrequired' => 'Devi essere iscritto per vedere questa pagina',
  'adminrequired' => 'Devi essere un amministratore per vedere questa pagina',
  'InvalidParameterException:APIMethodOrFunctionNotSet' => 'Metodo o una funzione non impostato nella chiamata in expose_method ()',
  'APIException:BadAPIKey' => 'Errore chiave API',
  'userpicker:only_friends' => 'Solo gli amici',
  'user:resetpassword:unknown_user' => 'Utente non valido',
  'user:resetpassword:reset_password_confirm' => 'Reimpostata la password spedita al tuo indirizzo email registrato ',
  'admin:user:label:searchbutton' => 'Ricerca',
  'untitled' => 'Senza titolo',
  'help' => 'Aiuto',
  'send' => 'Manda',
  'post' => 'Post',
  'submit' => 'Invia',
  'site' => 'Sito',
);

add_translation("it", $it);
