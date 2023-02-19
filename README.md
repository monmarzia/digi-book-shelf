## Setup del progetto:

Requisiti: PHP ^8.0, npm ^16 MySQL 8.0 --

Back End: Laravel/MySQL: --
    -   Avviare il server mySQL su porta 3306 (user "root password '') --
    -   aprire la cartella del progetto in  un terminale ed eseguire -- 
    ''' $ >npm install --
        $ >php artisan migrate:fresh --seed // Crea il database popolato con faker --
        $ >php artisan serve // avvia il server php (porta 8000) ''' --
    -   Aprire un'altro terminale dalla cartella del progetto e avviare il Front End: --
    ''' $ >npm run dev ''' --
        
