<?php
require_once '../../models/topic.php';
require_once '../../controllers/TopicController.php';
require_once '../../models/vars.php';

$topicController = new TopicController();
$topics = $topicController->getAllTopics();
?>
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-file-text-o menu-icon"></i><span class="nav-text">Topics</span>
                </a>
                <ul aria-expanded="false">
                    <?php
                    foreach ($topics as $topic) {
                        ?>
                        <li>
                            <a href="topicFeed.php?id=<?php echo $topic['topic_id']; ?>">
                                <div><?php echo $topic['topic_name'] ?></div>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
<!--                    <li><a href="../user/topicFeed.php">Wears</a></li>-->
                    <!-- <li><a href="./index-2.html">Home 2</a></li> -->
                </ul>
            </li>
        </ul>
    </div>
</div>