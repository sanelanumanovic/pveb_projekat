<?php


class ProcurementHelper {


	public static function getAllProcurementsBySupIdAndInterval($supplierId, $fromDate, $toDate) {
		if ($fromDate != null && $toDate != null) {
            $inventories = ProcurementHelper::getAllInventoryProcurementsByIntervalAndSupplier($supplierId, $fromDate, $toDate);
            $ingredients = ProcurementHelper::getAllIngredientProcurementsByIntervalAndSupplier($supplierId, $fromDate, $toDate);
        } else {
            $inventories = ProcurementHelper::getAllInventoryProcurementsBySupplierId($supplierId);
            $ingredients = ProcurementHelper::getAllIngredientProcurementsBySupplierId($supplierId);
        }

        return $inventories->union($ingredients)->orderBy('date')->get();
    }

    public static function getAllProcurementsByInterval($fromDate, $toDate) {
		if ($fromDate != null && $toDate != null) {
            $inventories = ProcurementHelper::getAllInventoryProcurementsByInterval($fromDate, $toDate);
            $ingredients = ProcurementHelper::getAllIngredientProcurementsByInterval($fromDate, $toDate);
        } else {
            $inventories = ProcurementHelper::getAllInventoryProcurements();
            $ingredients = ProcurementHelper::getAllIngredientProcurements();
        }

        return $inventories->union($ingredients);
    }


	private static function getAllInventoryProcurements() {
		return DB::table('procurements')->join('procurement_inventory_items', 'procurement_id', '=', 'id')
						                ->select(DB::raw('id, sum(procurement_inventory_items.price * procurement_inventory_items.quantity) as total, completion_date as date, "Nabavka inventara" as info'))
						                ->groupBy('id');
	}

	private static function getAllInventoryProcurementsBySupplierId($supplierId) {
		return DB::table('procurements')->join('procurement_inventory_items', 'procurement_id', '=', 'id')
										->where('supplier_id', $supplierId)
						                ->select(DB::raw('id, sum(procurement_inventory_items.price * procurement_inventory_items.quantity) as total, completion_date as date, "Nabavka inventara" as info'))
						                ->groupBy('id');
	}

	private static function getAllInventoryProcurementsByInterval($fromDate, $toDate) {
		return DB::table('procurements')->join('procurement_inventory_items', 'procurement_id', '=', 'id')
										->where('completion_date', '>=', $fromDate)
                						->where('completion_date', '<=', $toDate)
						                ->select(DB::raw('id, sum(procurement_inventory_items.price * procurement_inventory_items.quantity) as total, completion_date as date, "Nabavka inventara" as info'))
						                ->groupBy('id');
	}

	private static function getAllInventoryProcurementsByIntervalAndSupplier($supplierId, $fromDate, $toDate) {
		return DB::table('procurements')->join('procurement_inventory_items', 'procurement_id', '=', 'id')
										->where('supplier_id', $supplierId)
										->where('completion_date', '>=', $fromDate)
                						->where('completion_date', '<=', $toDate)
						                ->select(DB::raw('id, sum(procurement_inventory_items.price * procurement_inventory_items.quantity) as total, completion_date as date, "Nabavka inventara" as info'))
						                ->groupBy('id');
	}

	private static function getAllIngredientProcurements() {
		return DB::table('procurements')->join('procurement_items', 'procurement_id', '=', 'id')
						                ->select(DB::raw('id, sum(procurement_items.price * procurement_items.quantity) as total, completion_date as date, "Nabavka namirnica" as info'))
						                ->groupBy('id');
	}

	private static function getAllIngredientProcurementsBySupplierId($supplierId) {
		return DB::table('procurements')->join('procurement_items', 'procurement_id', '=', 'id')
										->where('supplier_id', $supplierId)
						                ->select(DB::raw('id, sum(procurement_items.price * procurement_items.quantity) as total, completion_date as date, "Nabavka namirnica" as info'))
						                ->groupBy('id');
	}

	private static function getAllIngredientProcurementsByInterval($fromDate, $toDate) {
		return DB::table('procurements')->join('procurement_items', 'procurement_id', '=', 'id')
										->where('completion_date', '>=', $fromDate)
						                ->where('completion_date', '<=', $toDate)
						                ->select(DB::raw('id, sum(procurement_items.price * procurement_items.quantity) as total, completion_date as date, "Nabavka namirnica" as info'))
						                ->groupBy('id');
	}

	private static function getAllIngredientProcurementsByIntervalAndSupplier($supplierId, $fromDate, $toDate) {
		return DB::table('procurements')->join('procurement_items', 'procurement_id', '=', 'id')
										->where('supplier_id', $supplierId)
										->where('completion_date', '>=', $fromDate)
						                ->where('completion_date', '<=', $toDate)
						                ->select(DB::raw('id, sum(procurement_items.price * procurement_items.quantity) as total, completion_date as date, "Nabavka namirnica" as info'))
						                ->groupBy('id');
	}

}