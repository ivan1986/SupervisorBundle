Supervisor Control Bundle
=========================

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/511fa5e9-1c95-4cb6-8e2f-4a8ed619e3ac/small.png)](https://insight.sensiolabs.com/projects/511fa5e9-1c95-4cb6-8e2f-4a8ed619e3ac)


This bundle for quick configure and usage separate instance of [supervisord](http://supervisord.org/).

All Symfony2 commands run supervisor from kernel.root_dir path.
If use config created by supervisor:init use [local configure file](http://supervisord.org/configuration.html).

install default by composer:

    "ivan1986/supervisor": "*",

Bundle has commands:

  * supervisor:init
    - create supervisord.conf file and supervisor folder in app folder
  * supervisor:run
    - check instance of supervisord and run it if need
    - add this command to cron - simple quick watchdog for supervisord
  * supervisor:control
    - run any supervisorCtl command
  * supervisor:gen
    - generate simple programm section for symfony2 console command

Example code for rabbitmq scale workers.

    $this->get('supervisor')->genProgrammConf('worker', array(
        'name' => 'worker',
        'command' => 'rabbitmq:consumer sender',
        'numprocs' => $this->getNeedWorkersCount(),
    ));
    $this->get('supervisor')->run();
    $this->get('supervisor')->reloadAndUpdate();

Service supervisor may run daemon, execute any command, and generate files for supervisord.
