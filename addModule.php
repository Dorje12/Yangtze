<div class="main_content sub_wrapper">
    <div class="header">
        <h1>Add Module</h1>
    </div>
    <main><div class="add_user">


            <?php echo form_open(); ?>
            <?= csrf_field(); ?>
             <?php if (session()->getTempdata('error')) {
                echo session()->getTempdata('error');
                }?>
            <table>
                <tbody>

                    <tr>
                        <th>
                            <label for="moduleName">Module Name</label>
                            
                        </th>
                        <td>
                            <input name="moduleName" id="moduleName" type="text" />
                           <span><?= display_error($validation, 'moduleName')?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="moduleId">Module ID</label>
                        </th>
                        <td>
                            <input name="moduleId" id="moduleId" type="text" />
                            <span><?= display_error($validation, 'moduleId')?></span>
                            
                           
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="Course">Course</label>
                        </th>
                        <td>
                            <input name="Course" id="Course" type="text" />
                            <span><?= display_error($validation, 'Course')?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="moduleLeader">Module Leader</label>
                        </th>
                        <td>
                            <input name="moduleLeader" id="moduleLeader" type="text" />
                            <span><?= display_error($validation, 'moduleLeader')?></span>                           
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="credit">Credit</label>
                        </th>
                        <td>
                            <input name="credit" id="credit" type="text" />
                            <span><?= display_error($validation, 'credit')?></span>
                        </td>
                    </tr>
                    <th>
                            <label for="Module_status">Status</label>
                        </th>
                        <td>
                            <input id="Module_status" name='Module_status' type="checkbox" value="active"/>
                            <tr>
                        <td>
                            <input type="submit" value="Submit"/>
                        </td>
                    </tr>
    </tbody>
            </table>

            <?php echo form_close(); ?>


        </div>


    </main>

</div>
</div>
</div>
</body>
</html>