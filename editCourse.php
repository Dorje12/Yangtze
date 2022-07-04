<div class="main_content sub_wrapper">
    <div class="header">
        <h1>Edit Course</h1>
    </div>
    <main>
        <div class="add_user">


            <?php echo form_open(); ?>
            <?= csrf_field() ?>
            <?php if (session()->getTempdata('error')) {
                echo session()->getTempdata('error');
            } ?>


            <table>
                <tbody>
                    <tr>
                        <th>
                            <label for="courseTitle">course Title</label>
                        </th>
                        <td>
                            <input name="courseTitle" id="courseTitle" type="text" value="<?= $courses->course_title; ?>" />
                            <span><?= display_error($validation, 'courseTitle') ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="courseId">Course ID</label>
                        </th>
                        <td>
                            <input name="courseId" id="courseId" type="text" value="<?= $courses->course_ID; ?>" />
                            <span><?= display_error($validation, 'courseId') ?></span>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="courseLeader">Course Leader</label>
                        </th>
                        <td>
                            <input name="courseLeader" id="courseLeader" type="text" value="<?= $courses->course_leader; ?>" />
                            <span><?= display_error($validation, 'courseLeader') ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="course_desc">Course description</label>
                        </th>
                        <td>
                            <input name="course_desc" id="course_desc" type="text" value="<?= $courses->course_desc; ?>" />
                            <span><?= display_error($validation, 'course_desc') ?></span>
                        </td>
                    </tr>
                    <th>
                        <label for="Course_status">Course Status</label>
                    </th>
                    <td>
                        <input id="Course_status" name='Course_status' type="checkbox" <?php if ($courses->course_status === "Active") : ?> checked <?php endif; ?> value="active" />
                        <tr>
                            <td>
                                <input type="submit" value="Submit" />
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