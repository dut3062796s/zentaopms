<?php
/**
 * The view file of story module of ZenTaoMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     story
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../file/view/download.html.php';?>

<div class='yui-d0'>
  <div id='titlebar'>
    <div id='main' <?php if($story->deleted) echo "class='deleted'";?>>STORY #<?php echo $story->id . $lang->colon . $story->title;?></div>
    <div>
    <?php
    $browseLink = $app->session->storyList != false ? $app->session->storyList : $this->createLink('product', 'browse', "productID=$story->product&moduleID=$story->module");
    if(!$story->deleted)
    {
        if(!($story->status != 'closed' and common::printLink('story', 'change', "storyID=$story->id", $lang->story->change))) echo $lang->story->change . ' ';
        if(!(($story->status == 'draft' or $story->status == 'changed') and common::printLink('story', 'review', "storyID=$story->id", $lang->story->review))) echo $lang->story->review . ' ';
        if(!($story->status != 'closed' and common::printLink('story', 'close', "storyID=$story->id", $lang->story->close))) echo $lang->story->close . ' ';
        if(!($story->status == 'closed' and $story->closedReason == 'postponed' and common::printLink('story', 'activate', "storyID=$story->id", $lang->story->activate))) echo $lang->story->activate . ' ';
        if(!common::printLink('story', 'edit',    "storyID=$story->id", $lang->edit)) echo $lang->edit . ' ';
        common::printLink('story', 'delete', "storyID=$story->id", $lang->delete, 'hiddenwin');
    }
    echo html::a($browseLink, $lang->goback);
    ?>
    </div>
  </div>
</div>

<div class='yui-d0 yui-t8'>
  <div class='yui-main'>
    <div class='yui-b'>
      <fieldset>
        <legend><?php echo $lang->story->legendSpec;?></legend>
        <div class='content'><?php echo $story->spec;?></div>
      </fieldset>
      <fieldset>
        <legend><?php echo $lang->story->legendAttatch;?></legend>
        <div>
        <?php 
        foreach($story->files as $file)
        {
            echo html::a($this->createLink('file', 'download', "fileID=$file->id"), $file->title, '_blank', "onclick='return downloadFile($file->id)'");
            echo html::commonButton('x', "onclick=deleteFile($file->id)");
        }
        ?>
        </div>
      </fieldset>
      <?php include '../../common/view/action.html.php';?>
      <div class='a-center' style='font-size:16px; font-weight:bold'>
      <?php
      if(!$story->deleted)
      {
          if(!($story->status != 'closed' and common::printLink('story', 'change', "storyID=$story->id", $lang->story->change))) echo $lang->story->change . ' ';
          if(!(($story->status == 'draft' or $story->status == 'changed') and common::printLink('story', 'review', "storyID=$story->id", $lang->story->review))) echo $lang->story->review . ' ';
          if(!($story->status != 'closed' and common::printLink('story', 'close', "storyID=$story->id", $lang->story->close))) echo $lang->story->close . ' ';
          if(!($story->status == 'closed' and $story->closedReason == 'postponed' and common::printLink('story', 'activate', "storyID=$story->id", $lang->story->activate))) echo $lang->story->activate . ' ';
          if(!common::printLink('story', 'edit',    "storyID=$story->id", $lang->edit)) echo $lang->edit . ' ';
          common::printLink('story', 'delete', "storyID=$story->id", $lang->delete, 'hiddenwin');
      }
      echo html::a($browseLink, $lang->goback);
      ?>
      </div>
    </div>
  </div>

  <div class='yui-b'>
   <fieldset>
     <legend><?php echo $lang->story->legendBasicInfo;?></legend>
     <table class='table-1'>
       <tr>
         <td class='rowhead w-p20'><?php echo $lang->story->product;?></td>
         <td><?php common::printLink('product', 'view', "productID=$story->product", $product->name);?>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->module;?></td>
         <td> 
           <?php
           foreach($modulePath as $key => $module)
           {
               if(!common::printLink('product', 'browse', "productID=$story->product&browseType=byModule&param=$module->id", $module->name)) echo $module->name;
               if(isset($modulePath[$key + 1])) echo $lang->arrow;
           }
           ?>
         </td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->plan;?></td>
         <td><?php if(isset($story->planTitle)) if(!common::printLink('productplan', 'view', "planID=$story->plan", $story->planTitle)) echo $story->planTitle;?>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->status;?></td>
         <td><?php echo $lang->story->statusList[$story->status];?></td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->stage;?></td>
         <td><?php echo $lang->story->stageList[$story->stage];?></td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->pri;?></td>
         <td><?php echo $lang->story->priList[$story->pri];?></td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->estimate;?></td>
         <td><?php echo $story->estimate;?></td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->keywords;?></td>
         <td><?php echo $story->keywords;?></td>
       </tr>
     </table>
   </fieldset>
   <fieldset>
     <legend><?php echo $lang->story->legendLifeTime;?></legend>
     <table class='table-1'>
       <tr>
         <td class='rowhead w-p20'><?php echo $lang->story->openedBy;?></td>
         <td><?php echo $users[$story->openedBy] . $lang->at . $story->openedDate;?></td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->assignedTo;?></td>
         <td><?php if($story->assignedTo) echo $users[$story->assignedTo] . $lang->at . $story->assignedDate;?></td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->reviewedBy;?></td>
         <td><?php $reviewedBy = explode(',', $story->reviewedBy); foreach($reviewedBy as $account) echo ' ' . $users[trim($account)]; ?></td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->reviewedDate;?></td>
         <td><?php if($story->reviewedBy) echo $story->reviewedDate;?></td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->closedBy;?></td>
         <td><?php if($story->closedBy) echo $users[$story->closedBy] . $lang->at . $story->closedDate;?></td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->closedReason;?></td>
         <td>
           <?php
           if($story->closedReason) echo $lang->story->reasonList[$story->closedReason];
           if(isset($story->extraStories[$story->duplicateStory]))
           {
               echo html::a(inlink('view', "storyID=$story->duplicateStory"), '#' . $story->duplicateStory . ' ' . $story->extraStories[$story->duplicateStory]);
           }
           ?>
         </td>
       </tr>
       <tr>
         <td class='rowhead'><?php echo $lang->story->lastEditedBy;?></td>
         <td><?php if($story->lastEditedBy) echo $users[$story->lastEditedBy] . $lang->at . $story->lastEditedDate;?></td>
       </tr>
     </table>
   </fieldset>

   <fieldset>
     <legend><?php echo $lang->story->legendProjectAndTask;?></legend>
     <table class='table-1 fixed'>
       <tr>
         <td>
           <?php
           foreach($story->tasks as $projectTasks)
           {
               foreach($projectTasks as $task)
               {
                   @$projectName = $story->projects[$task->project]->name;
                   echo html::a($this->createLink('project', 'browse', "projectID=$task->project"), $projectName);
                   echo '<span class="nobr">' . html::a($this->createLink('task', 'view', "taskID=$task->id"), "#$task->id $task->name") . '</span><br />';
               }
           }
           ?>
         </td>
       </tr>
     </table>
   </fieldset>

   <fieldset>
     <legend><?php echo $lang->story->legendLinkStories;?></legend>
     <div>
       <?php
       $linkStories = explode(',', $story->linkStories) ;    
       foreach($linkStories as $linkStoryID)
       {
           if(isset($story->extraStories[$linkStoryID])) echo html::a(inlink('view', "storyID=$linkStoryID"), "#$linkStoryID " . $story->extraStories[$linkStoryID]) . '<br />';
       }
       ?>
     </div>
   </fieldset>
   <fieldset>
     <legend><?php echo $lang->story->legendChildStories;?></legend>
     <div>
       <?php
       $childStories = explode(',', $story->childStories) ;    
       foreach($childStories as $childStoryID)
       {
           if(isset($story->extraStories[$childStoryID])) echo html::a(inlink('view', "storyID=$childStoryID"), "#$childStoryID " . $story->extraStories[$childStoryID]) . '<br />';
       }
       ?>
     </div>
   </fieldset>
   <fieldset>
     <legend><?php echo $lang->story->legendMailto;?></legend>
     <div><?php $mailto = explode(',', $story->mailto); foreach($mailto as $account) echo ' ' . $users[trim($account)]; ?></div>
   </fieldset>
   <fieldset>
     <legend><?php echo $lang->story->legendVersion;?></legend>
     <div><?php for($i = $story->version; $i >= 1; $i --) echo html::a(inlink('view', "storyID=$story->id&version=$i"), "#$i");?></div>
   </fieldset>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
