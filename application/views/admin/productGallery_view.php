<!-- content starts -->
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-camera"></i> <?php echo $page_title; ?> </h2>
            <?php if ($product_name != '') { ?>
                <h2>&nbsp;of <?php echo $product_name; ?></h2>
            <?php } ?>
        </div>
        <div class="box-content">
            <div id="errorMsg"></div>
            <!--  start content-table-inner START -->
            <div id="content-table-inner">
                <!--  start table-content  -->
                <div id="table-content">
                    <div id="fileupload">
                        <?php echo form_open_multipart($action); ?>
                        <div class="fileupload-buttonbar">

                            <input type="file" name="files[]" multiple>
                            <button type="reset" class="cancel">Cancel upload</button>
                            <button type="reset" class="cancel" onClick="javascript:history.back();">Back</button>
                        </div>
                        <div class="fileupload-content">
                            <table class="files" border="1" width="100%" cellpadding="0" cellspacing="0"></table>
                            <div class="fileupload-progressbar"></div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                    <script id="template-upload" type="text/x-jquery-tmpl">
                        <tr class="template-upload{{if error}} ui-state-error{{/if}}">
                        <td class="preview" width="10%"></td>
                        <td class="name" width="30%">${name}</td>
                        <td class="size" width="10%">${sizef}</td>
                        <td colspan="2"><b>Image Title :</b> <input type="text" name="imgTitle[]" class="inp-form"></td>
                        {{if error}}
                        <td class="error" colspan="2">Error:
                        {{if error === 'maxFileSize'}}File is too big
                        {{else error === 'minFileSize'}}File is too small
                        {{else error === 'acceptFileTypes'}}Filetype not allowed
                        {{else error === 'maxNumberOfFiles'}}Max number of files exceeded
                        {{else}}${error}
                        {{/if}}
                        </td>
                        {{else}}
                        <td class="start"><button>Start</button></td>
                        {{/if}}
                        <td class="cancel"><button>Cancel</button></td>
                        </tr>
                    </script>
                    <script id="template-download" type="text/x-jquery-tmpl">
                        <tr class="template-download{{if error}} ui-state-error{{/if}}">
                        {{if error}}
                        <td class="preview" width="10%"></td>
                        <td class="name" width="30%">${name}</td>
                        <td class="size" width="10%">${sizef}</td>                        
                        <td class="error" colspan="2">Error:
                        {{if error === 1}}File exceeds upload_max_filesize (php.ini directive)
                        {{else error === 2}}File exceeds MAX_FILE_SIZE (HTML form directive)
                        {{else error === 3}}File was only partially uploaded
                        {{else error === 4}}No File was uploaded
                        {{else error === 5}}Missing a temporary folder
                        {{else error === 6}}Failed to write file to disk
                        {{else error === 7}}File upload stopped by extension
                        {{else error === 'maxFileSize'}}File is too big
                        {{else error === 'minFileSize'}}File is too small
                        {{else error === 'acceptFileTypes'}}Filetype not allowed
                        {{else error === 'maxNumberOfFiles'}}Max number of files exceeded
                        {{else error === 'uploadedBytes'}}Uploaded bytes exceed file size
                        {{else error === 'emptyResult'}}Empty file upload result
                        {{else}}${error}
                        {{/if}}
                        </td>
                        {{else}}
                        <td class="preview" width="10%">
                        {{if thumbnail_url}}
                        <a href="${url}" class="cboxElement" target="_blank"><img src="${thumbnail_url}"  width="80" height="80"></a>
                        {{/if}}
                        </td>
                        <td class="name" width="30%">
                        <a href="${url}"{{if thumbnail_url}} target="_blank"{{/if}}>${name}</a>
                        </td>
                        <td class="size" width="10%">${sizef}</td>
                        <td colspan="2" width="40%">${imgTitle}</td>
                        {{/if}}
                        <td class="delete">
                        <a class="btn" href="javascript:void(0)" onClick="xajax_deleteImg('<?php echo $productId ?>','${name}')"><i class="icon-trash"></i></a>
                        </td>
                        <td class="{{if isMainImg}}mainImg{{else}}setMainImg{{/if}}">
                        <a class="btn" href="javascript:void(0)" onClick="xajax_setMainImg('<?php echo $productId ?>','${name}')"><i class="icon-{{if isMainImg}}star{{else}}picture{{/if}}"></i></a>
                        </td>
                        </tr>
                    </script>

                    <script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/file_upload/jquery.min.js"></script>
                    <script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/file_upload/jquery-ui.min.js"></script>
                    <script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/file_upload/jquery.tmpl.min.js"></script>
                    <script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/file_upload/jquery.iframe-transport.js"></script>
                    <script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/file_upload/jquery.fileupload.js"></script>
                    <script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/file_upload/jquery.fileupload-ui.js"></script>
                    <script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/file_upload/example/application.js"></script>
                </div>
                <!--  end table-content  -->

                <div class="clear"></div>

            </div>
            <!--  end content-table-inner END  -->
        </div>					
    </div><!--/span-->
</div><!--/row-->	
<!-- content ends -->