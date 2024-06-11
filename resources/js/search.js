import axios from "axios";

const classes = {
    admin: "bg-emerald-100 text-green-700",
    user: "bg-sky-100 text-blue-600",
};

const styles = {
    admin: "background-color: #d1fae5; color: #15803d;",
    user: "background-color: #e0f2fe; color: #2563eb;",
};

const row = (visitor) => {
    return `
        <tr class="trow flex items-center cursor-pointer rounded-xl justify-around border-t border-gray-200">
            <td class="flex-[100%] flex items-center gap-2 font-bold">
                <div
                    style="width: 2.25rem; height: 2.25rem; color: #002d55;"
                    class="border-1 border-gray-200 size-9 rounded-full grid place-items-center bg-gray-100 text-xs font-normal">
                    ${visitor.first_name[0]}${visitor.last_name[0]}
                </div>
                ${visitor.first_name} ${visitor.last_name}
            </td>
            <td class="flex-[100%]">${visitor.email}</td>
            <td class="flex-[50%]">${visitor.gender}</td>
            <td class="flex-[50%]">
                <span style="${styles[visitor.role]} padding: 0.2rem 0.875rem;" class="text-sm rounded">
                    ${visitor.role}
                </span>
            </td>
            <td class="flex-[50%]">${new Date(
                visitor.created_at
            ).toLocaleDateString("en-US", {
                month: "short",
                day: "numeric",
                year: "numeric",
            })}</td>
        </tr>`;
};

document.addEventListener("DOMContentLoaded", async function () {
    try {
        const { data } = await axios.get("/visitors");

        sortby.innerText = "name";

        table.innerHTML = data.map((visitor) => row(visitor)).join("\n");

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
            const value = this.value.toLowerCase();
            table.innerHTML = data
                .map((visitor) => {
                    if (
                        (visitor.first_name + visitor.last_name)
                            .toLowerCase()
                            .includes(value) ||
                        visitor.email.toLowerCase().includes(value)
                    ) {
                        return row(visitor);
                    }
                })
                .join("\n");
        });
    } catch (error) {
        console.log(error);
    }
});
