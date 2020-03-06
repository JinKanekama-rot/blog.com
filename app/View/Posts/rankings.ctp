<?= $this->assign('title', "ランキング"); ?>
<h1>記事ランキング</h1>
<div class="row">
    <div class="col-md-2">
    <ul>
        <li><a href="/posts/rankings/total">総合</a></li>
        <li><a href="/posts/rankings/animal">動物</a></li>
        <li><a href="/posts/rankings/programming">プログラミング</a></li>
        <li><a href="/posts/rankings/others">その他</a></li>
    </ul>
    </div>
    <div class="rankings-contents col-md-7">
        <?php foreach($rankings as $item):?>
            <a href="/posts/view/<?=$item['Post']['id']?>">
                <div class="row">
                    <?php  $day = new DateTime($item['Post']['created']);?>
                    <div class="col-3 time-box"><span class="time"><?=$day->format('m/d H時');?></span></div>
                    <div class="col-7 title-box"><span class="title"><?=h($item['Post']['title']);?></span></div>
                    <div class="col-2 author-box"><span class="author">by<?= h($item['User']['username']);?></span></div>
                </div>
            </a>
        <?php endforeach?>
        <?php echo $this->element('pager')?> 
    </div>
    <div class="others-contents col-md-3">
    </div>
</div>