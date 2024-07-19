<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) : ?>
    <link rel="stylesheet" href="<?php echo PATH_URL_STYLE . 'admin.css' ?>">

    <!-- <body onload="onload()"> -->

    <body>
        <button id="add-product" class="btn-primary" onclick="showadd()">Add new product</button>
        <div id="add-product-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="hiddenModal()">&times;</span>
                <form id="add-form" onsubmit="return submitadd(event,this)">
                    <h3 id="modal-title">Add Product</h3>
                    <div class="modal-body">
                        <div style="display:flex;justify-content:center;flex-direction:column">
                            <div class="inline-modal">

                                <div for="Name" class="label">Product name <span style="color:red">(*)</span></div>
                                <input id="Name" name="Name" type="text" maxlength="100" class="name-product" required />

                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="CategoryId" class="label">Category <span style="color:red">(*)</span></div>
                                    <select id="CategoryId" name="CategoryId" required>
                                        <?php
                                        foreach ($category as $value) {
                                            echo '<option value="' . $value["Categorie"]["id"] . '">' . $value["Categorie"]["name"] . '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <div for="SubCategoryId" class="label">SubCategoryId </div>
                                    <select id="SubCategoryId" name="SubCategoryId">
                                        <?php
                                        foreach ($subcategory as $value) {
                                            echo '<option value="' . $value["Subcategory"]["id"] . '">' . $value["Subcategory"]["name"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <!-- <input class="SubCategoryId" name="SubCategoryId" /> -->
                                </div>
                            </div>

                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Price" class="label">Price <span style="color:red">(*)</span></div>
                                    <input id="Price" name="Price" type="number" required />
                                </div>
                                <div class="form-group">
                                    <div for="Color" class="label">Color:</div>
                                    <input id="Color" name="Color" />
                                </div>


                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Material" class="label">Material <span style="color:red">(*)</span></div>
                                    <input id="Material" name="Material" maxlength="200" required />
                                </div>
                                <div class="form-group">
                                    <div for="Size" class="label">Size</div>
                                    <input id="Size" name="Size" type="20" />
                                </div>
                            </div>
                            <div class="inline-modal">
                                <div class="form-group1">
                                    <div for="isSaleOff" class="label">isSaleOff</div>
                                    <input id="isSaleOff" name="isSaleOff" type="checkbox" />
                                </div>

                                <div class="form-group">
                                    <div for="Percent_off" class="label">Percent_off</div>
                                    <input id="Percent_off" name="Percent_off" type="number" min="0" max="99" />
                                </div>
                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Image1" class="label">Image1 <span style="color:red">(*)</span></div>
                                    <input id="Image1" name="Image1" required />
                                </div>
                                <div class="form-group">
                                    <div for="Image2" class="label">Image2</div>
                                    <input id="Image2" name="Image2" />
                                </div>
                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Image3" class="label">Image3</div>
                                    <input id="Image3" name="Image3" required />
                                </div>
                                <div class="form-group">
                                    <div for="Image4" class="label">Image4</div>
                                    <input id="Image4" name="Image4" />
                                </div>
                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Alias" class="label">Alias <span style="color:red">(*)</span></div>
                                    <input id="Alias" name="Alias" type="text" maxlength="200" required />
                                </div>
                                <div class="form-group">
                                    <div for="Quantity" class="label">Quantity <span style="color:red">(*)</span></div>
                                    <input id="Quantity" name="Quantity" required />
                                </div>
                            </div>
                            <div class="inline-modal">

                                <div for="Description" class="label">Description </div>
                                <textarea id="Description" name="Description" class="name-product"></textarea>

                            </div>
                            <button type="submit" class="btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="edit-product-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="hiddenModal()">&times;</span>

                <form id="edit-form" onsubmit="return submitedit(event,this)">

                    <h3 id="modal-title">Edit Product</h3>
                    <div class="modal-body">
                        <div style="display:flex;justify-content:center;flex-direction:column">
                            <div class="form-group">
                                <input id="Id" name="Id" type="text" maxlength="100" value="" hidden />
                            </div>
                            <div class="inline-modal">

                                <div for="Name" class="label">Product name </div>
                                <input id="Name" name="Name" type="text" maxlength="100" class="name-product" disable />

                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="CategoryId" class="label">Category</span></div>
                                    <select id="CategoryId" name="CategoryId" disabled>
                                        <?php
                                        foreach ($category as $value) {
                                            echo '<option value="' . $value["Categorie"]["id"] . '">' . $value["Categorie"]["name"] . '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <div for="SubCategoryId" class="label">SubCategoryId </div>
                                    <select id="SubCategoryId" name="SubCategoryId" disabled>
                                        <?php
                                        foreach ($subcategory as $value) {
                                            echo '<option value="' . $value["Subcategory"]["id"] . '">' . $value["Subcategory"]["name"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Price" class="label">Price <span style="color:red">(*)</span></div>
                                    <input id="Price" name="Price" type="number" required />
                                </div>
                                <div class="form-group">
                                    <div for="Color" class="label">Color:</div>
                                    <input id="Color" name="Color" disabled />
                                </div>


                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Material" class="label">Material <span style="color:red">(*)</span></div>
                                    <input id="Material" name="Material" maxlength="200" />
                                </div>
                                <div class="form-group">
                                    <div for="Size" class="label">Size</div>
                                    <input id="Size" name="Size" type="20" disabled />
                                </div>
                            </div>
                            <div class="inline-modal">
                                <div class="form-group1">
                                    <div for="isSaleOff" class="label">isSaleOff</div>
                                    <input id="isSaleOff" name="isSaleOff" type="checkbox" />
                                </div>

                                <div class="form-group">
                                    <div for="Percent_off" class="label">Percent_off</div>
                                    <input id="Percent_off" name="Percent_off" type="number" min="0" max="99" />
                                </div>
                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Image1" class="label">Image1 <span style="color:red">(*)</span></div>
                                    <input id="Image1" name="Image1" required />
                                </div>
                                <div class="form-group">
                                    <div for="Image2" class="label">Image2</div>
                                    <input id="Image2" name="Image2" />
                                </div>
                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Image3" class="label">Image3</div>
                                    <input id="Image3" name="Image3" required />
                                </div>
                                <div class="form-group">
                                    <div for="Image4" class="label">Image4</div>
                                    <input id="Image4" name="Image4" />
                                </div>
                            </div>
                            <div class="inline-modal">
                                <div class="form-group">
                                    <div for="Alias" class="label">Alias <span style="color:red">(*)</span></div>
                                    <input id="Alias" name="Alias" type="text" maxlength="200" disabled />
                                </div>
                                <div class="form-group">
                                    <div for="Quantity" class="label">Quantity <span style="color:red">(*)</span></div>
                                    <input id="Quantity" name="Quantity" required />
                                </div>
                            </div>
                            <div class="inline-modal">

                                <div for="Description" class="label">Description </div>
                                <textarea id="Description" name="Description" class="name-product"></textarea>

                            </div>
                            <button type="submit" class="btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Size</th>
                        <th>Create at</th>
                        <th>Edit at</th>
                        <th>isSaleOff</th>
                        <th>% sale</th>
                        <th style="max-width: 200px">Image</th>
                        <th>Alias</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-body"></tbody>
            </table>
        </div>
        <div class="pagination">
            <div id="pagination" class="page">
            </div>
            <div class="select">
                Page size
                <select id="select-page-size" style="margin-right: 5px">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
                Total: <span id="total-items"></span>
            </div>
        </div>
    </body>


    <script>
        let filter = {
            pageSize: 5,
            currentPage: 1,
        };
        document.addEventListener("DOMContentLoaded", async function() {
            getData(filter);
            let selectPageSize = document.getElementById("select-page-size");
            selectPageSize.addEventListener("change", pageSizeChange);
        });
        var maxPage, page, size;

        function getData(filter) {
            var url = `?url=admin/view/${filter.currentPage}/${filter.pageSize}&api`;
            let data = [];
            var xmlhttp = new XMLHttpRequest();
            let rNumb = filter.pageSize;
            xmlhttp.open('GET', url, true);
            xmlhttp.send();
            xmlhttp.responseType = 'json';
            xmlhttp.onreadystatechange =
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4) {
                        response = xmlhttp.response
                        console.log(response.data)
                        if (response.success) {
                            data = response.data
                            renderTable({
                                products: data['data'],
                                total: data['total'],
                                pageSize: filter.pageSize,
                                currentPage: filter.currentPage,
                            })
                        } else {

                        }
                    }
                }

            //     resolve();
            // });
        }

        function renderTable(data) {
            let products = data.products || [];
            let total = data.total || 0;
            let pageSize = data.pageSize || 5;
            let currentPage = data.currentPage || 1;
            let tableBody = document.querySelector(
                ".table-wrapper .table .table-body"
            );
            if (products.length == 0) {
                tableBody.innerHTML = `
            <tr>
              <td style="height: 500px; text-align: center;" colspan="17">Không có dữ liệu</td>
              </tr>
              `;
                return;
            }
            tableBody.innerHTML = "";
            for (let productItem of products) {
                let product = productItem.Product
                let tr = document.createElement("tr");
                tr.appendChild(createTD(product.Name, "Name"));
                tr.appendChild(createTD(product.CategoryId, "CategoryId"));
                tr.appendChild(createTD(product.SubCategoryId, "SubCategoryId"));
                tr.appendChild(createTD(product.Description, "Description"));
                tr.appendChild(createTD(product.Price, "Price"));
                tr.appendChild(createTD(product.Color, "Color"));
                tr.appendChild(createTD(product.Material, "Material"));
                tr.appendChild(createTD(product.Size, "Size"));
                tr.appendChild(createTD(product.Createdate, "Createdate"));
                tr.appendChild(createTD(product.EditDate, "EditDate"));
                tr.appendChild(createTD(product.isSaleOff == 1 ? "Yes" : "No"));
                tr.appendChild(createTD(product.Percent_off));
                let imgs = [
                    createLink(product.Image1, "Image1"),
                    createLink(product.Image2, "Image2"),
                    createLink(product.Image3, "Image3"),
                    createLink(product.Image4, "Image4"),
                ];
                let imgsElement = createTD(imgs, "imglist");
                tr.appendChild(imgsElement);
                tr.appendChild(createTD(product.Alias), "alias");
                tr.appendChild(createTD(product.Quantity));
                tr.appendChild(createTDAction(product));
                tableBody.append(tr);
            }
            renderPagination(total, pageSize, currentPage);
        }

        function renderPagination(total, pageSize, currentPage) {
            maxPage = Math.ceil(total / pageSize);
            page = currentPage;
            size = pageSize;
            let pageSelect = [];
            if (maxPage <= 1) {
                pageSelect = [1];
            } else if (currentPage < 3) {
                pageSelect.push(...[1, 2]);
                for (let i = 3; i < 6; i++) {
                    if (i < maxPage) pageSelect.push(i);
                }
            } else if (currentPage > maxPage - 2) {
                for (let i = maxPage; i > maxPage - 5; i--) {
                    pageSelect.unshift(i);
                }
            } else {
                for (let i = currentPage - 2; i < currentPage + 3; i++) {
                    pageSelect.push(i);
                }
            }

            let totalElement = document.getElementById("total-items");
            totalElement.innerText = total;
            let pagination = document.getElementById("pagination");
            pagination.innerHTML = "";
            let prev = document.createElement("a");
            prev.innerText = "Prev";
            prev.addEventListener("click", () => pageChange(page - 1));
            pagination.appendChild(prev);

            for (let p of pageSelect) {
                let curPageElement = document.createElement("a");
                curPageElement.innerText = p;
                if (page == p) {
                    curPageElement.classList.add("active");
                }
                curPageElement.addEventListener("click", () => pageChange(p));
                pagination.appendChild(curPageElement);
            }

            let next = document.createElement("a");
            next.innerText = "Next";
            next.addEventListener("click", () => pageChange(page + 1));
            pagination.appendChild(next);
        }

        function pageChange(p) {
            if (p < 1) p = 1;
            if (p > maxPage) p = maxPage;
            if (p == page) return;
            let filter = {
                pageSize: size,
                currentPage: p,
            };
            getData(filter);
        }

        function createTD(childNode, idname = null) {
            let td = document.createElement("td");
            if (idname != null)
                td.setAttribute("id", idname);
            if (Array.isArray(childNode)) {
                childNode.forEach((e) => td.append(e));
                return td;
            }
            td.append(childNode);
            return td;
        }

        function createLink(url, text) {
            let link = document.createElement("a");
            link.setAttribute("href", "public/images/product/" + url);
            link.setAttribute("target", "blank");
            link.innerText = text;
            link.style.marginRight = "5px";
            return link;
        }

        function createTDAction(row) {
            let td = document.createElement("td");
            let buttonEdit = createLinkButton("Edit", () => editRow(row));
            td.append(buttonEdit);
            return td;
        }

        function createLinkButton(name, callback) {
            let btn = document.createElement("span");
            btn.classList.add("link-btn");
            btn.innerText = name;
            btn.addEventListener("click", callback);
            return btn;
        }

        function editRow(row) {
            console.log(row)
            let modal = document.getElementById("edit-product-modal");
            modal.style.display = "block";
            let modalTitle = document.getElementById("modal-title");
            for (let i in row) {
                let ele = document.querySelector(`#edit-product-modal #${i}`);
                if (ele) {
                    if (i == "Description" || i == "Material") {
                        ele.value = htmlspecialchars_decode(row[i])
                    } else if (i == "isSaleOff") {
                        ele.checked = (row[i] == "1" ? true : false);
                    } else
                        ele.value = row[i];
                }
            }
        }

        function deleteRow(row) {
            let modal = document.getElementById("add-product-modal");
            modal.style.display = "block";
            let modalTitle = document.getElementById("modal-title");
            console.log(row);
        }

        function onload() {
            let filter = {
                pageSize: 10,
                currentPage: 1,
            };
            getData(filter);
            let selectPageSize = document.getElementById("select-page-size");
            selectPageSize.addEventListener("change", pageSizeChange);
            initModal();
        }

        function pageSizeChange(e) {
            let pageSize = e.target.value;
            let filter = {
                pageSize,
                currentPage: 1,
            };
            getData(filter);
        }

        function initModal() {
            let modal = document.getElementById("edit-product-modal");
            let modalDelete = document.getElementById("add-product-modal");

            let btn = document.getElementById("add-product");
            let spans = document.getElementsByClassName("close");

            btn.onclick = function() {
                modal.style.display = "block";
                let modalTitle = document.getElementById("modal-title");
                modalTitle.innerText = "Thêm sản phẩm";
            };
            for (let span of spans) {
                span.onclick = function() {
                    modal.style.display = "none";
                    modalDelete.style.display = "none";
                };
            }

            window.onclick = function(event) {
                if (event.target == modal || event.target == modalDelete) {
                    modal.style.display = "none";
                    modalDelete.style.display = "none";
                }
            };
        }

        function hiddenModal() {
            let modal = document.getElementById("edit-product-modal");
            let modalDelete = document.getElementById("add-product-modal");
            modal.style.display = "none";
            modalDelete.style.display = "none";
        }

        function showadd() {
            let modalDelete = document.getElementById("add-product-modal");
            modalDelete.style.display = "block";

        }

        function submitadd(e, form) {
            e.preventDefault();
            let data = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '?url=admin/add&api=1', true);
            xhr.responseType = 'json';
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    response = xhr.response
                    if (response.success) {
                        document.getElementById("response").innerHTML = "Product added!";
                        var header = document.getElementById("inner-header")
                        header.innerHTML = "Success";
                        header.style.color = "green"
                    } else {
                        document.getElementById("response").innerHTML = response.message;
                        var header = document.getElementById("inner-header")
                        header.innerHTML = "Add failed!";
                        header.style.color = "red"
                    }
                    var popup = document.getElementById("popup");
                    popup.style.display = "block";
                }
            }
            xhr.send(data);
        }

        function submitedit(e, form) {
            e.preventDefault();
            let data = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '?url=admin/edit&api=1', true);
            xhr.responseType = 'json';
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    response = xhr.response
                    if (response.success) {
                        document.getElementById("response").innerHTML = "Product updated!";
                        var header = document.getElementById("inner-header")
                        header.innerHTML = "Success";
                        header.style.color = "green"
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2024);
                    } else {
                        document.getElementById("response").innerHTML = response.message;
                        var header = document.getElementById("inner-header")
                        header.innerHTML = "Edit failed!";
                        header.style.color = "red"
                    }
                    var popup = document.getElementById("popup");
                    popup.style.display = "block";
                }
            }
            xhr.send(data);
        }

        function htmlspecialchars_decode(str) {
            if (typeof(str) == "string") {
                str = str.replace(/&gt;/ig, ">");
                str = str.replace(/&lt;/ig, "<");
                str = str.replace(/&#039;/g, "'");
                str = str.replace(/&quot;/ig, '"');
                str = str.replace(/&amp;/ig, '&'); 
            }
            return str;
        }
    </script>

<?php endif ?>