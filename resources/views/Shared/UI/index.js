import Brand from "./Brand.vue";
import PageHeading from "./PageHeading.vue";
import Icon from "./Icon.vue";
import Pagination from "./Pagination.vue";
import Link from "./Buttons/Link.vue";
import Button from "./Buttons/Button.vue";

/**
 * Buttons
 */
import PanelButton from "./Buttons/PanelButton.vue";

import Table from "./Tables/Table.vue";
import TableHeader from "./Tables/TableHeader.vue";
import TableCell from "./Tables/TableCell.vue";

/**
 * Panels
 */
import Panel from "./Panels/Panel.vue";

/**
 * Forms
 */
import SearchInput from "./Forms/SearchInput.vue";
import Input from "./Forms/Input.vue";
import Form from "./Forms/Form.vue";

/**
 * Spinners
 */
import Loading from "./Loading.vue"

/**
 * Cards
 */
import CardLayout from "./Cards/CardLayout.vue";


export {
    Icon,
    Brand as UiBrand,
    PageHeading as UiPageHeading,
    Pagination as UiPagination,

    /**
     * Buttons
     */
    Link as UiLink,
    Button as UiButton,
    PanelButton,

    /**
     * Table
     */
    Table as UiTable,
    TableHeader as UiTh,
    TableCell as UiTd,

    /**
     * Panles
     */
    Panel as UiPanel,

    /**
     * Forms
     */
    SearchInput,
    Input as UiInput,
    Form as UiForm,

    /**
     * Spinners
     */
    Loading as UiLoading,

    /**
     * Cards
     */
    CardLayout,
}