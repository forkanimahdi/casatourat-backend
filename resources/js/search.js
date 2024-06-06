document.addEventListener("DOMContentLoaded", function () {
    sortby.innerText = "name";

    sortbtn.addEventListener("click", () =>
        sortdialog.open ? sortdialog.close() : sortdialog.show()
    );

    this.querySelectorAll(".sortitem").forEach((sortitem) => {
        sortitem.addEventListener("click", function () {
            sortby.innerText = this.dataset.name;
            sortdialog.close();
        });
    });

    search.addEventListener("input", function () {
        let content = "";
        const value = this.value.toLowerCase();

        for (const visitor of visitors) {
            if (
                (visitor.first_name + visitor.last_name)
                    .toLowerCase()
                    .includes(value) ||
                visitor.email.toLowerCase().includes(value)
            ) {
                content += `<tr class="w-ful flex items-center py-2 justify-around border-t border-gray-200">
                        <td class="flex-1 flex items-center gap-2">
                            <div class="border border-gray-300 size-10 rounded-full"></div>
                            ${visitor.first_name} ${visitor.last_name}
                        </td>
                        <td class="flex-1">${visitor.email}</td>
                        <td class="flex-1">${visitor.gender}</td>
                        <td class="flex-1">${new Date(
                            visitor.created_at
                        ).toLocaleDateString("en-US", {
                            month: "short",
                            day: "numeric",
                            year: "numeric",
                        })}</td>
                    </tr>`;
            }
        }
        table.innerHTML = content;
    });
});
