<div class="main_content sub_wrapper">
        <div class="header">
                <h1>Courses</h1>
                <?php
                        if (session()->getTempdata('error')) {
                                echo session()->getTempdata('error');
                        }
                        ?>

                <?php if($userRole['role'] === 'Admin'):?>
                        <div class="dash-button">
                         <a href="<?= base_url('dashboard/courses/add_course'); ?>">Add Courses</a>
                         <style>
                                .dash-button:hover{
                                        background-color: #4CAF50; /* Green */
                                        width: 10%;
                                        text-align: center;
                                        color: white;
                                        transition-duration: 0.4s;
                                }

                                .dash-button{
                                        background-color: #115740;
                                        width: 10%;
                                        text-align: center;
                                        color: white;
                                        margin-top: 20px;
                                        margin-bottom: 20px;
                                }
                         </style>
                </div>
                <?php endif; ?>

        </div>
        <main>
        <style>
table, th, td {
  border: 1px solid black;
}

th, td{
        padding:10px;
}
</style>
        <table>
                
                <tr>
                        <th>Course Title</th>
                        <th>Course ID</th>
                        <th>Course Leader</th>
                        <th>Course description</th>
                        <th>Course Status</th>
                        <th>Actions</th>
                </tr>

                <?php foreach($courseData as $Course):?>
                <tr>
                        <td><?= $Course->course_title ?>
                        <td><?= $Course->course_ID ?></td>
                        <td><?= $Course->course_leader?></td>
                        <td><?= $Course->course_desc?></td>
                        <td><?= $Course->course_status?></td>
                        <td><ul>
                                <a href="<?= base_url('dashboard/courses/edit_course/'.$Course->id); ?>"><li><i class="fa-solid fa-pen-to-square"></i> edit</li></a>
                                <a href="<?= base_url('dashboard/courses/delete_course/'.$Course->id);?>"><li><i class="fa-solid fa-trash"></i> delete</li></a>
                        </ul></td>
                        
                </tr>
                        <?php endforeach; ?>
        </table>


        </main>
        <footer>

        </footer>
</div>
</div>
</div>
</body>
</html>