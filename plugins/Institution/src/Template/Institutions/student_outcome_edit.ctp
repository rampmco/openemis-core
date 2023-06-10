<?= $this->Html->script('app/components/alert/alert.svc', ['block' => true]); ?>
<?= $this->Html->script('Institution.angular/student_outcomes/institution.student.outcomes.ctrl', ['block' => true]); ?>
<?= $this->Html->script('Institution.angular/student_outcomes/institution.student.outcomes.svc', ['block' => true]); ?>
<?php
$this->extend('OpenEmis./Layout/Panel');
$this->start('toolbar');
?>
<?= $this->Html->link('<i class="fa kd-back"></i>', $viewUrl, ['class' => 'btn btn-xs btn-default', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'data-container' => 'body', 'title' => __('Back'), 'escapeTitle' => false]) ?>

<?= $this->Html->link('<i class="fa kd-lists"></i>', $indexUrl, ['class' => 'btn btn-xs btn-default', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'data-container' => 'body', 'title' => __('List'), 'escapeTitle' => false]) ?>
<?php
$this->end();
$this->start('panelBody');
?>
<style type="text/css">
    .ag-body-container {
        max-height:400px;
        width:auto !important;
    }
    .ag-floating-bottom-viewport 
    .ag-floating-bottom-container .ag-row{min-height:110px;}
    .sg-theme .ag-cell{border-bottom: 1px solid #DDD;}
</style>
<form accept-charset="utf-8" id="content-main-form" class="ng-pristine ng-valid" novalidate="novalidate" ng-controller="InstitutionStudentOutcomesCtrl as InstitutionStudentOutcomesController" ng-init="InstitutionStudentOutcomesController.classId=<?= $classId ?>; InstitutionStudentOutcomesController.outcomeTemplateId=<?= $outcomeTemplateId ?>;">
    <div class="form-horizontal">
        <div class="alert {{InstitutionStudentOutcomesController.class}}" ng-hide="InstitutionStudentOutcomesController.message == null">
            <a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>{{InstitutionStudentOutcomesController.message}}
        </div>
        <div class="input string required">
            <label><?= __('Class Name') ?></label>
            <input ng-model="InstitutionStudentOutcomesController.className" type="text" disabled="disabled">
        </div>
        <div class="input string required">
            <label><?= __('Academic Period') ?></label>
            <input ng-model="InstitutionStudentOutcomesController.academicPeriodName" type="text" disabled="disabled">
        </div>
        <div class="input string required">
            <label><?= __('Outcome Template') ?></label>
            <input ng-model="InstitutionStudentOutcomesController.outcomeTemplateName" type="text" disabled="disabled">
        </div>
    </div>
    <div class="clearfix"></div>
    <hr>
    <h3><?= __('Student') ?></h3>
    <div class="dropdown-filter">
        <div class="filter-label">
            <i class="fa fa-filter"></i>
            <label><?= __('Filter')?></label>
        </div>
        <div class="select">
            <label><?= __('Outcome Period') ?>:</label>
            <div class="input-select-wrapper">
                <select name="outcome_period" ng-options="period.id as period.code_name for period in InstitutionStudentOutcomesController.periodOptions" ng-model="InstitutionStudentOutcomesController.selectedPeriod" ng-change="InstitutionStudentOutcomesController.changeOutcomeOptions(true);">
                    <option value="" ng-if="InstitutionStudentOutcomesController.periodOptions.length == 0"><?= __('No Options') ?></option>
                </select>
            </div>
        </div>
        <div class="select">
            <label><?= __('Subject') ?>:</label>
            <div class="input-select-wrapper">
                <select name="education_subject" ng-options="subject.id as subject.code_name for subject in InstitutionStudentOutcomesController.subjectOptions" ng-model="InstitutionStudentOutcomesController.selectedSubject" ng-change="InstitutionStudentOutcomesController.changeOutcomeOptions(false);">
                    <option value="" ng-if="InstitutionStudentOutcomesController.subjectOptions.length == 0"><?= __('No Options') ?></option>
                </select>
            </div>
        </div>
        <div class="select">
            <label><?= __('Student') ?>:</label>
            <div class="input-select-wrapper">
                <select name="student" ng-options="student.student_id as student.user.name_with_id for student in InstitutionStudentOutcomesController.studentOptions" ng-model="InstitutionStudentOutcomesController.selectedStudent" ng-change="InstitutionStudentOutcomesController.changeStudentOptions(true);">
                    <option value="" ng-if="InstitutionStudentOutcomesController.studentOptions.length == 0"><?= __('No Options') ?></option>
                </select>
            </div>
        </div>
        <div class="text">
            <label><?= __('Status') ?></label>
            <input ng-model="InstitutionStudentOutcomesController.selectedStudentStatus" type="text" disabled="disabled">
        </div>

    </div>
    <div id="institution-student-outcome-table" class="table-wrapper">
        <div ng-if="InstitutionStudentOutcomesController.dataReady" kd-ag-grid="InstitutionStudentOutcomesController.gridOptions"></div>
    </div>
</form>

<?php
$this->end();
?>
