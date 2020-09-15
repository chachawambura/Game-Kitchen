<?php $rows = userModel::listActivities( $myid ); ?>

<table width="100%">
<tr class="tabular_titles"><td colspan="3">My Activities</td></tr>

<?php if( empty( $rows ) ) { ?>
	<tr><td colspan="3">No records</td></tr>
<?php } else { ?>
    

    <?php for( $i=0; $i < count( $rows ); $i++ ) : ?>
        <?php $row = &$rows[$i]; ?> 
        <?php $bg = ( $i%2 == 0 ) ? $bg_light : $bg_dark;?> 
        <tr bgcolor="<?php echo $bg; ?>">                  
            <td><a href="<?php echo $row->url; ?>"><?php echo userModel::defineUserActivities( $row->activity_id ); ?></a></td>
        </tr> 
    <?php endfor; ?>
<?php } ?>
</table> 