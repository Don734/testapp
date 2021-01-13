class NoName {
    constructor(modal, id) {
        this.modal = modal;
        this.id = id;
        this.url = window.location.href;
        this.state = 'active';
    }

    addUser() {
        $(this.modal).addClass(this.state);

        document.getElementsByClassName('modalForm-control')[0].action = this.url;

        $("#methodPut").remove();
        $("#fullname").val('');
        $("#email").val('');
        $("#phone").val('');
        $("#group").val('');
        $("#addNewUser").val('Добавить');
    }

    editUser() {
        $(this.modal).addClass(this.state);

        document.getElementsByClassName('modalForm-control')[0].action = this.url + '/' + this.id;

        $.ajax({
            type: "GET",
            url: this.url + '/' + this.id,
            dataType: "json",
            success: function (response) {
                $("#modalAddUser form").prepend('<input id="methodPut" type="hidden" name="_method" value="PUT">');
                $("#fullname").val(response.fullname);
                $("#email").val(response.email);
                $("#phone").val(response.phone);
                $("#group").val(response.group);
                $("#addNewUser").val('Сохранить');
            }
        });
    }

    addGroup() {
        $(this.modal).addClass(this.state);

        document.getElementsByClassName('modalForm-control')[0].action = this.url;

        $("#methodPut").remove();
        $("#groupname").val('');
        $("#addNewGroup").val('Добавить');
    }

    editGroup() {
        $(this.modal).addClass(this.state);

        document.getElementsByClassName('modalForm-control')[0].action = this.url + '/' + this.id;

        $.ajax({
            type: "GET",
            url: this.url + '/' + this.id,
            dataType: "json",
            success: function (response) {
                let rolePermissions = response.rolePermissions;
                saveCheckbox(rolePermissions);
                $("#modalAddGroup form").prepend('<input id="methodPut" type="hidden" name="_method" value="PUT">');
                $("#groupname").val(response.role.name);
                $("#addNewGroup").val('Сохранить');
            }
        });
    }

    addTable() {
        $(this.modal).addClass(this.state);

        document.getElementsByClassName('modalForm-control')[0].action = this.url;

        $("#methodPut").remove();
        $("#project").val('');
        $("#description").val('');
        $("#name").val('');
        $("#score").val('');
        $("#codeproduct").val('');
        $("#unit").val('');
        $("#addNewTable").val('Добавить');
    }

    editTable() {
        $(this.modal).addClass(this.state);

        document.getElementsByClassName('modalForm-control')[0].action = this.url + '/' + this.id;

        $.ajax({
            type: "GET",
            url: this.url + '/' + this.id,
            dataType: "json",
            success: function (response) {
                $("#modalTable form").prepend('<input id="methodPut" type="hidden" name="_method" value="PUT">');
                $("#project").val(response.project);
                $("#name").val(response.name);
                $("#score").val(response.score);
                $("#codeproduct").val(response.codeprod);
                $("#unit").val(response.unit);
                $("#weight").val(response.weight);
                $("#size").val(response.size);
                $("#comingprev").val(response.comingcur);
                $("#addNewTable").val('Сохранить');
            }
        });
    }

    editExpensTable() {
        $(this.modal).addClass(this.state);

        document.getElementsByClassName('modalFormExpens-control')[0].action = this.url + '/' + this.id;

        $.ajax({
            type: "GET",
            url: this.url + '/' + this.id,
            dataType: "json",
            success: function (response) {
                $("#expensprev").val(response.expenscur);
                $("#balanceprev").val(response.balancecur);
            }
        });
    }
}

$(document).ready(function () {
    $('#addUser').click(function () {
        let user = new NoName('#modalAddUser');
        user.addUser();
    })

    $('.editUser').click(function () {
        let id = $(this).data('id')

        let user = new NoName('#modalAddUser', id);
        user.editUser();
    })

    $('#addGroup').click(function () {
        let group = new NoName('#modalAddGroup');
        group.addGroup();
    })

    $('.editGroup').click(function () {
        let id = $(this).data('id');

        let group = new NoName('#modalAddGroup', id);
        group.editGroup();
    })

    $('#addTable').click(function () {
        let table = new NoName('#modalTable');
        table.addTable();
    })

    $('.editTable').click(function () {
        let id = $(this).data('id');

        let table = new NoName('#modalTable', id);
        table.editTable();
    })

    $('.editExpens').click(function () {
        let id = $(this).data('id');

        let table = new NoName('#modalExpens', id);
        table.editExpensTable();
    })

    $('.modalForm__close').click(function () {
        $(this).parent().removeClass('active');
    })

    $('.accordion__title').click(function () {
        $(this).siblings().slideToggle(300);
        $(this).toggleClass('active');
    })
})

function saveCheckbox(permissions) {
    document.querySelectorAll(".chkbox").forEach((el, i) => {
        permissions[el.value] ? el.checked = true : el.checked = false;
    })
}