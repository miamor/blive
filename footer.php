			</div>
		</div>
		<div class="clearfix"></div>
	</div>

		<script src="<?php echo JQUERY ?>/jquery-1.7.2.min.js"></script>
		<script src="<?php echo JQUERY ?>/jquery-ui-1.10.4.js"></script>
		<!-- SCROLL JS -->
		<script src="assets/plugins/nicescroll/jquery.nicescroll.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="assets/js/bootstrap.js"></script>
<!--		<script src="assets/js/bootstrap-tooltip.js"></script> -->
		<script src="assets/js/bootstrap-confirmation.js"></script>
		<!-- CHOOSEN (SELECT) -->
		<script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
		<!-- FLAT UI -->
		<script src="assets/plugins/flat-ui/js/jquery.tagsinput.js"></script>
		<script src="assets/plugins/flat-ui/js/flatui-checkbox.js"></script>
		<script src="assets/plugins/flat-ui/js/flatui-radio.js"></script>
		<!-- PLUGINS -->
<!--		Set in lesson page only
		<script src="assets/plugins/fancybox/fancybox.js"></script> -->
<!--		<script src="<? echo PLUGINS ?>/colorbox/jquery.colorbox.js"></script> -->
		<!-- MAIN APPS JS -->
		<script src="assets/js/main.js"></script>
		<script src="assets/plugins/sceditor/minified/jquery.sceditor.js"></script>
		<script src="assets/plugins/meditor/jquery.meditor.js"></script>
		
<script> var emoticonsList = {
			dropdown: {<? echo emoTextareaDropdown() ?>},
			more: {<? echo emoTextareaMore() ?>}
		};
function sce(a) {
	$('#' + a).find('textarea').meditor();
/*	$('#' + a).find("textarea").not('.no-toolbar, .non-sce').sceditor({
		emoticons: emoticonsList
	});
	$('#' + a).find('.no-toolbar').sceditor({
		toolbar: '',
		emoticons: emoticonsList
	})
*/}
</script>
	</body>
</html>
