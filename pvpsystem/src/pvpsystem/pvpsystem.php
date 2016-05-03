<?php

namespace pvpsystem;


 use pocketmine\event\entity\EntityDamageEvent;
 use pocketmine\event\entity\EntityDamageByEntityEvent;
 use pocketmine\event\entity\EntityDeathEvent;
 use pocketmine\event\player\PlayerDeathEvent;
 use pocketmine\event\Listener;

 use pocketmine\plugin\PluginBase;
 use pocketmine\plugin\PluginManager;
 use pockertmie\Server;
 use pocketmine\Player;

 use pocketmine\utils\TextFormat;
 use pocketmine\math\Vector3;

 use pocketmine\entity\Effect;

 use pocketmine\item\Item;


 class pvpsystem extends PluginBase implements Listener{



     public function onEnable(){    //Pluginが読み込まれたときの処理

             $this->getServer()->getPluginManager()->registerEvents($this,$this);  //Eventの登録
 
             $this->getServer()->getLogger()->info(TextFormat::GREEN."pvpsystemを読み込みました");  //インフォメーション

     }

    public function onDamage(EntityDamageEvent $ev){  //Entityがダメージを食らった時の処理

            if($ev instanceof EntityDamageByEntityEvent){  //EventがEntityDamageByEntityEventか調べる

          
                      $player = $ev->getEntity();    //殴られたEntityを取得

                      
                      if($player instanceof Player){ //殴られたEntityがPlayerかどうか調べる

                                $health = $player->getHealth();  //Playerの現在の体力を取得

                                if($health <= 4){  //体力が2以下になった時の処理

                                        $effect = Effect::getEffect(5); //Effectの指定

                                        $effect->setDuration(20 * 20); //持続時間
                                        $effect->setAmplifier(1); //効果の強さ
                                        $effect->setVisible(false); //パーティクルを表示するかどうか
                                        $player->addEffect($effect);  //Playerにエフェクトを付加


                                 }
                        }
               }
     }


    
 
      public function onPlayerDeath(PlayerDeathEvent $ev){



		$ev->setDeathMessage(null); //死んだときのMessageを消す

            $player = $ev->getEntity();

            if($player instanceof Player){

                    $item = Item::get(266,0,1);
                    $item2 = Item::get(332,0,1);

                    $items = array($item,$item2);

                    $ev->setDrops($items);   

                    $username = $player->getName();  //名前を取得

                    $this->getServer()->broadcastPopup("§6".$username."§bは死んでしまった");


            }
 
        
      }
    

}   