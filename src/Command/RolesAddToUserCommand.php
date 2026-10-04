<?php
declare(strict_types=1);

namespace App\Command;

use App\Component\User\UserManager;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Attribute\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'roles:add-to-user',
    description: 'Add a short description for your command',
    aliases: ['r:add']
)]
class RolesAddToUserCommand extends Command{
    public function __construct( private UserRepository $repository, private UserManager $userManager)
    {
        parent::__construct();
    }
//    protected function configure()
//    {
//       $this
//           ->addArgument('arg1', InputArgument::REQUIRED, 'Yangi Argument')
//           ->addOption('option1', null, InputOption::VALUE_NONE, 'Yangi Option');
//    }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
      $io = new SymfonyStyle($input, $output);
      $idQuestion = new Question('ID kiriting:');
      $roleQuestion = new Question('Rol kiriting:');
      $questionHelper = $this->getHelper('question');
      $id = null;
      $role = null;
      $user = null;


while(!$user){
      while (!$id){
          $id = $questionHelper->ask($input, $output, $idQuestion);
          if(!$id){
              $io->warning('ID kiritish majburiy');
          }}
    $user = $this->repository->find($id);
      if(!$user){
          $io->warning('Bunday ID ga ega user mavjud emas');
          exit();
      }
      }


      while (!$role){
            $role = $questionHelper->ask($input, $output, $roleQuestion);
            if(!$role){
                $io->warning('Ro\'l kiritish majburiy');
            }
      }



      if($user->getRoles()){
          $roles = $user->getRoles();
          if(in_array($role, $roles,true)){
              $io->warning("Userda allaqachon {$role} roli mavjud");
              return Command::SUCCESS;
          }

          $roles[] = $role;


          $user->setRoles($roles);
          $this->userManager->save($user,  true);

          $io->success("Userga yangi {$role} roli qo'shildi");
      }
      return Command::SUCCESS;
  }
}
